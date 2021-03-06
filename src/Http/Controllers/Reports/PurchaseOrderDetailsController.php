<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Rutatiina\PurchaseOrder\Models\PurchaseOrder;

class PurchaseOrderDetailsController extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }
    }

    public function generate()
    {
        //$tenant = Auth::user()->tenant;

        //purchase-order
        //->where('base_currency', $tenant->base_currency)
        $invoices = PurchaseOrder::latest('date')
            ->paginate();

        return [
            'tableData' => $invoices,
            'opening_date' => date('Y-m-d'),
            'closing_date' => date('Y-m-d')
        ];
    }

}
