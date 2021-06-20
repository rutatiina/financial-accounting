<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Reports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\Contact\Traits\ContactTrait;
use Rutatiina\FinancialAccounting\Traits\FinancialAccountingTrait;


class TrialBalanceController extends Controller
{
    //use TenantTrait;
    use ContactTrait;
    use FinancialAccountingTrait;

    public function __construct()
    {
    }

    public function index()
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson())
        {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }
    }

    public function generate(Request $request)
    {
        //opening date
        $openingDate = ($request->opening_date) ? $request->opening_date : date('Y-m-d', strtotime('-1 years'));

        //closing date
        $closingDate = ($request->closing_date) ? $request->closing_date : date('Y-m-d');

        //currency
        $currency = ($request->currency) ? $request->currency : Auth::user()->tenant->base_currency;

        $financialAccountType = [
            'asset',
            'equity',
            'expense',
            'contra-expense',
            'income',
            'revenue',
            'contra-revenue',
            'liability',
            'cost_of_sales'
        ];

        //get all the accounts
        //$Accounts = Account::whereIn('type', ['Asset','Equity','Expense','Income','Liability','Purchase','CostOfSales'])->get();
        $Accounts = Account::select('id', 'code', 'name', 'type')
            ->whereIn('type', $financialAccountType)
            ->get()
            ->groupBy('type');

        //get the accounts the user has debited or credited in period
        $affectedAccounts = AccountBalance::select('financial_account_code')->where('currency', $currency)->groupBy('financial_account_code')->get()->keyBy('financial_account_code')->toArray();
        //print_r($AccountBalance); exit;
        $affectedAccountsCodes = array_keys($affectedAccounts);

        $totalDebit = 0;
        $totalCredit = 0;

        //loop through them and get the opening and closing balance of each
        //return $Accounts;

        foreach ($Accounts as $accountType)
        {
            foreach ($accountType as &$account)
            {

                if (!in_array($account->code, $affectedAccountsCodes))
                {
                    $account->total_debit = 0;
                    $account->total_credit = 0;
                    continue;
                }

                //opening account balance
                $openingBalance = AccountBalance::whereDate('date', '<=', $openingDate)
                    ->where([
                        ['financial_account_code', $account->code],
                        ['currency', $currency],
                    ])
                    ->orderBy('date', 'desc')
                    ->first();

                //closing account balance
                $closingBalance = AccountBalance::whereDate('date', '<=', $closingDate)
                    ->where([
                        ['financial_account_code', $account->code],
                        ['currency', $currency],
                    ])
                    ->orderBy('date', 'desc')
                    ->first();

                //data cleaning
                if ($openingBalance && $closingBalance && $openingBalance->date == $closingBalance->date)
                {

                    $amountDebited = $openingBalance->debit; //or $closingBalance->debit;
                    $amountCredited = $openingBalance->credit; //or $closingBalance->credit

                }
                else
                {

                    //clean opening debit balance
                    $openingDebit = optional($openingBalance)->debit;
                    $openingDebit = (is_numeric($openingDebit)) ? $openingDebit : 0;

                    //clean closing debit balance
                    $closingDebit = optional($closingBalance)->debit;
                    $closingDebit = (is_numeric($closingDebit)) ? $closingDebit : 0;

                    //clean opening credit balance
                    $openingCredit = optional($openingBalance)->credit;
                    $openingCredit = (is_numeric($openingCredit)) ? $openingCredit : 0;

                    //clean closing credit balance
                    $closingCredit = optional($closingBalance)->credit;
                    $closingCredit = (is_numeric($closingCredit)) ? $closingCredit : 0;

                    $amountDebited = $closingDebit - $openingDebit;
                    $amountCredited = $closingCredit - $openingCredit;

                }

                $account->total_debit = $amountDebited;
                $account->total_credit = $amountCredited;

                $totalDebit += $amountDebited;
                $totalCredit += $amountCredited;

            }
        }

        $balancingFigure = ($totalDebit - $totalCredit);
        $balancingFigure = abs($balancingFigure);

        //view('accounting::reports.trial-balance.show')

        return [
            'accounts' => $Accounts,
            'totalDebit' => $totalDebit,
            'totalCredit' => $totalCredit,
            'currency' => $currency,
            'openingDate' => $openingDate,
            'closingDate' => $closingDate,
            'balancingFigure' => $balancingFigure,
        ];
    }

}
