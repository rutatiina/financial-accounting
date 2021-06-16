<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Reports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Rutatiina\FinancialAccounting\Classes\Reports\BalanceSheet;

class BalanceSheetController extends Controller
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

    public function generate()
	{
        $BalanceSheet = new BalanceSheet([]);
        $statement = $BalanceSheet->generate();
        return $statement;
        //return view('accounting::reports.balance_sheet')->with($statement);
    }

}
