<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Reports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\Invoice\Models\Invoice;
use Rutatiina\CreditNote\Models\CreditNote;
use Rutatiina\FinancialAccounting\Models\ContactBalance;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\Contact\Models\Contact;
use Rutatiina\GoodsDelivered\Models\GoodsDeliveredItem;
use Rutatiina\GoodsReceived\Models\GoodsReceivedItem;
use Rutatiina\Item\Models\Item;
use Rutatiina\PurchaseOrder\Models\PurchaseOrderItem;

class InventoryReportsController extends Controller
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

    //inventory summary report
    public function summary(Request $request)
    {
        $tenant = Auth::user()->tenant;

        #Get items
        $items = Item::all();

        foreach ($items as &$item)
        {
            /*
             * -- Add the following fields to each contact --
             * $item->quantity_ordered
             * $item->sales
             * $item->sales_with_tax
             */

            $item->quantity_ordered = 0;
            $item->quantity_in = 0;
            $item->quantity_out = 0;
            $item->stock_on_hand = 0;
            $item->stock_committed = 0;
            $item->stock_available_for_sale = 0;

            if (class_exists(\Rutatiina\PurchaseOrder\Models\PurchaseOrderItem::class))
            {
                $item->quantity_ordered = PurchaseOrderItem::where('item_id', $item->id)->sum('quantity');
            }

            if (class_exists(\Rutatiina\GoodsReceived\Models\GoodsReceivedItem::class))
            {
                $item->quantity_in = GoodsReceivedItem::where('item_id', $item->id)->sum('quantity');
            }

            if (class_exists(\Rutatiina\GoodsDelivered\Models\GoodsDeliveredItem::class))
            {
                $item->quantity_out = GoodsDeliveredItem::where('item_id', $item->id)->sum('quantity');
            }

        }

        return [
            'items' => $items
        ];
    }

}
