<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Reports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Rutatiina\FinancialAccounting\Classes\Reports\ProfitAndLoss;

class ProfitAndLossController extends Controller
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
		$ProfitAndLoss = new ProfitAndLoss([]);
		$statement = $ProfitAndLoss->generate();
		return $statement;
        //return view('accounting::reports.profit_and_loss')->with($statement);
	}

}
