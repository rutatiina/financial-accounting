<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Reports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\Invoice\Models\InvoiceItem;
use Rutatiina\FinancialAccounting\Models\ContactBalance;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\Contact\Models\Contact;
use Rutatiina\Item\Models\Item;

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
        $total_quantity = 0;
        $total_amount = 0;


        #Get contacts
        $items = Item::select('id', 'name')->get();

        foreach ($items as &$item)
        {

            /*
             * -- Add the following fields to each contact --
             * $contact->invoice_count
             * $contact->sales
             * $contact->sales_with_tax
             */

            #get total number of invoices per contact
            $itemSales = InvoiceItem::whereHas("invoice")
                ->select(
                    DB::raw('SUM(quantity) as total_quantity'),
                    DB::raw('SUM(total) as total_amount'),
                    DB::raw('AVG(rate) as avg_rate')
                )
                //->where('type', 'item') //todo look at this
                ->where('item_id', $item->id)
                ->groupBy('item_id')
                ->first();

            if ($itemSales)
            {
                $item->total_quantity = $itemSales->total_quantity;
                $item->total_total = $itemSales->total_amount;
                $item->avg_rate = $itemSales->avg_rate;

                $total_quantity += $itemSales->total_quantity;
                $total_amount += $itemSales->total_amount;
            }
            else
            {
                $item->total_quantity = 0;
                $item->total_total = 0;
                $item->avg_rate = 0;
            }

        }

        $total_avg_rate = ($total_quantity > 0) ? ($total_amount / $total_quantity) : 0;

        return [
            'opening_date' => date('Y-m-d'),
            'closing_date' => date('Y-m-d'),
            'items' => $items,
            'total_quantity' => $total_quantity,
            'total_amount' => $total_amount,
            'total_avg_rate' => $total_avg_rate
        ];
    }

}
