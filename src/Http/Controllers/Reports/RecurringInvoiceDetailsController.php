<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Rutatiina\Invoice\Models\RecurringInvoice;
use Illuminate\Support\Facades\Request as FacadesRequest;

class RecurringInvoiceDetailsController extends Controller
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

        //recurring-invoice
        $invoices = RecurringInvoice::with('recurring')
            //->where('base_currency', $tenant->base_currency)
            ->latest('date')
            ->paginate();

        return [
            'tableData' => $invoices,
            'opening_date' => date('Y-m-d'),
            'closing_date' => date('Y-m-d')
        ];
    }

}
