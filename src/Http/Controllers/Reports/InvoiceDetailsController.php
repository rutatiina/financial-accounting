<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Rutatiina\Invoice\Models\Invoice;

class InvoiceDetailsController extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }
    }

    public function generate(Request $request)
    {
        //$tenant = Auth::user()->tenant;

        //->where('base_currency', $tenant->base_currency)
        $invoices = Invoice::latest('date')
            ->paginate();

        return [
            'tableData' => $invoices,
            'opening_date' => date('Y-m-d'),
            'closing_date' => date('Y-m-d')
        ];
    }

}
