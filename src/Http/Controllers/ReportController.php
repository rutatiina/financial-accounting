<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Rutatiina\FinancialAccounting\Models\Txn;
use Rutatiina\FinancialAccounting\Classes\Transaction;
//use Rutatiina\Tenant\Traits\TenantTrait;
use Rutatiina\Contact\Traits\ContactTrait;
use Rutatiina\FinancialAccounting\Traits\FinancialAccountingTrait;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    //use TenantTrait;
    use ContactTrait;
    use FinancialAccountingTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
	{
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }
	}

    public function create() {}

    public function store(Request $request) {}

    public function show($txnId) {
        $txn = Transaction::transaction($txnId);
        //print_r($txn); exit;
        return view('accounting::sales.estimates.show')->with([
            'txn'       => $txn,
        ]);
    }

    public function edit($txnId) {}

    public function update(Request $request) {}

    public function destroy() {}

    public function datatables() {

        $txns = Transaction::paginate(false)->findByEntree('estimate');

        return Datatables::of($txns)->make(true);
    }

    public function exportToExcel() {
        $export = Txn::all()->downloadExcel(
            'invoices.xlsx',
            null,
            false
        );

        //$books->load('author', 'publisher'); //of no use

        return $export;
    }
}
