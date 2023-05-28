<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Rutatiina\Item\Models\Item;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Rutatiina\Contact\Models\Contact;
use Rutatiina\Sales\Models\SalesItem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\LazyCollection;
use Rutatiina\POS\Models\POSOrderItem;
use Illuminate\Database\Schema\Blueprint;
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


            $itemRowsTempTableName = 'item_'.$item->id.'_rows';
            Schema::create($itemRowsTempTableName, function (Blueprint $table) {
                $table->increments('id');
                $table->integer('tenant_id');
                $table->integer('item_id');
                $table->unsignedDecimal('rate', 20,5);
                $table->temporary();
            });

            SalesItem::select('tenant_id', 'item_id', 'rate')
            ->where('item_id', $item->id)
            ->whereIn('credit_financial_account_code', $revenueAccounts)
            ->whereHas('sale', function ($query) use ($openingDate, $closingDate) {
                $query->whereDate('date', '>=', $openingDate);
                $query->whereDate('date', '<=', $closingDate);
            })
            ->chunk(500, function ($rows) use ($itemRowsTempTableName)
            {
                $sql = '';
                foreach ($rows as $row) 
                {
                    $sql .= "('".implode("','", $row->toArray())."'),";
                }
                $sql = rtrim($sql, ',');
                DB::insert(DB::raw("INSERT INTO {$itemRowsTempTableName}(tenant_id, item_id, rate) VALUES {$sql}"));
            });

            InvoiceItem::select('tenant_id', 'item_id', 'rate')
            ->where('item_id', $item->id)
            ->whereIn('credit_financial_account_code', $revenueAccounts)
            ->whereHas('invoice', function ($query) use ($openingDate, $closingDate) {
                $query->whereDate('date', '>=', $openingDate);
                $query->whereDate('date', '<=', $closingDate);
            })
            ->chunk(500, function ($rows) use ($itemRowsTempTableName)
            {
                $sql = '';
                foreach ($rows as $row) 
                {
                    $sql .= "('".implode("','", $row->toArray())."'),";
                }
                $sql = rtrim($sql, ',');
                DB::insert(DB::raw("INSERT INTO {$itemRowsTempTableName}(tenant_id, item_id, rate) VALUES {$sql}"));
            });

            POSOrderItem::select('tenant_id', 'item_id', 'rate')
            ->where('item_id', $item->id)
            ->whereIn('credit_financial_account_code', $revenueAccounts)
            ->whereHas('pos_order', function ($query) use ($openingDate, $closingDate) {
                $query->whereDate('date', '>=', $openingDate);
                $query->whereDate('date', '<=', $closingDate);
            })
            ->chunk(500, function ($rows) use ($itemRowsTempTableName)
            {
                $sql = '';
                foreach ($rows as $row) 
                {
                    $sql .= "('".implode("','", $row->toArray())."'),";
                }
                $sql = rtrim($sql, ',');
                DB::insert(DB::raw("INSERT INTO {$itemRowsTempTableName}(tenant_id, item_id, rate) VALUES {$sql}"));
            });
        
            // return  DB::table($itemRowsTempTableName)->get();

            $averageRate = DB::table($itemRowsTempTableName)
                ->select('tenant_id', 'item_id', DB::raw('AVG(rate) as avg_rate'))
                ->where('item_id', $item->id)
                ->groupBy('item_id', 'tenant_id')
                ->first();
            $item->avg_rate = $averageRate->avg_rate ?? 0;

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

            Schema::drop($itemRowsTempTableName);

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
