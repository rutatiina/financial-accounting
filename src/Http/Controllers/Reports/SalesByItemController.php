<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Rutatiina\Item\Models\Item;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Rutatiina\Contact\Models\Contact;
use Rutatiina\Sales\Models\SalesItem;
use Rutatiina\Invoice\Models\InvoiceItem;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\FinancialAccounting\Models\ItemBalance;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\FinancialAccounting\Models\ContactBalance;
use Illuminate\Support\Facades\Request as FacadesRequest;

class SalesByItemController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson())
        {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }
    }

    public function generate(Request $request)
    {
        $openingDate = $request->opening_date ?? date('Y-m-d');
        $closingDate = $request->closing_date ?? date('Y-m-d');

        $total_quantity = 0;
        $total_amount = 0;

        $tenant = Auth::user()->tenant;

        #Get contacts
        $items = Item::select('id', 'name')->get();

        #Get all revenue accounts
        $revenueAccounts = Account::where('type', 'revenue')->pluck('code')->toArray();

        foreach ($items as &$item)
        {
            #total sales
            $salesBalances = ItemBalance::where('currency', $tenant->base_currency)
                ->select(
                    DB::raw('SUM(debit) as total_debit'),
                    DB::raw('SUM(credit) as total_credit'),
                    DB::raw('SUM(quantity) as total_quantity')
                )
                ->groupBy('item_id')
                ->where('item_id', $item->id)
                ->whereIn('financial_account_code', $revenueAccounts)
                ->whereDate('date', '>=', $openingDate)
                ->whereDate('date', '<=', $closingDate)
                ->orderBy('date', 'desc')
                ->first();

            //return $salesBalances;

            //get the AVERAGE PRICE
            $averageRate = SalesItem::select('item_id', DB::raw('AVG(rate) as avg_rate'))
                ->where('item_id', $item->id)
                ->whereIn('credit_financial_account_code', $revenueAccounts)
                ->whereHas('sale', function ($query) use ($openingDate, $closingDate) {
                    $query->whereDate('date', '>=', $openingDate);
                    $query->whereDate('date', '<=', $closingDate);
                })
                // ->groupBy('item_id')
                ->first();
            $item->avg_rate = $averageRate->avg_rate;

            if ($salesBalances)
            {
                $item->total_quantity = $salesBalances->total_quantity;
                $item->total_total = ($salesBalances->total_credit - $salesBalances->total_debit);

                $total_quantity += $salesBalances->total_quantity;
                $total_amount += ($salesBalances->total_credit - $salesBalances->total_debit);
            }
            else
            {
                $item->total_quantity = 0;
                $item->total_total = 0;
            }

        }

        $total_avg_rate = ($total_quantity > 0) ? ($total_amount / $total_quantity) : 0;

        return [
            'opening_date' => $openingDate,
            'closing_date' => $closingDate,
            'items' => $items,
            'total_quantity' => $total_quantity,
            'total_amount' => $total_amount,
            'total_avg_rate' => $total_avg_rate
        ];
    }

}
