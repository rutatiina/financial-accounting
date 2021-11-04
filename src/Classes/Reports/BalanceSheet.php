<?php

namespace Rutatiina\FinancialAccounting\Classes\Reports;

use Illuminate\Support\Facades\Auth;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\FinancialAccounting\Classes\Reports\ProfitAndLoss;

class BalanceSheet
{
    public $tenant = null;
    public $opening_date = null; //date('Y-m-d');
    public $closing_date = null;
    public $currency = 'UGX';

    //--------------------------------------------------------------------------
    public function __construct($parameters)
    {
        $this->tenant = Auth::user()->tenant;
        $this->currency = (isset($parameters['currency'])) ? $parameters['currency'] : Auth::user()->tenant->base_currency;
        $this->opening_date = (isset($parameters['opening_date'])) ? $parameters['opening_date'] : date('Y-m-d', strtotime('-1 years'));
        $this->closing_date = (isset($parameters['closing_date'])) ? $parameters['closing_date'] : date('Y-m-d');
    }

    public function opening_date()
    {
        $fiscal_year_start = $this->tenant->fiscal_year_start; // m-d
        //Determine start of accounting year

        $today = strtotime('now');
        $last_year = date('Y') - 1;

        //Find the begininf of the account year based on the Closing date
        if (strtotime($this->closing_date) >= strtotime(date('Y-') . $fiscal_year_start))
        {
            $fiscal_year_opening_date = date('Y-') . $fiscal_year_start;
        }
        else
        {
            $fiscal_year_opening_date = $last_year . '-' . $fiscal_year_start;
        }

        //echo $this->opening_date . ' vs ' . date('Y-') . $fiscal_year_start;

        if (strtotime($this->opening_date) >= strtotime(date('Y-') . $fiscal_year_start))
        {
            //Do nothing
        }
        else
        {
            //If the opening date false in another financila year - limit it to the year based on closing date
            if (strtotime($this->opening_date) < strtotime($fiscal_year_opening_date))
            {
                $this->opening_date = $fiscal_year_opening_date;
            }
            else
            {
                $this->opening_date = $last_year . '-' . $fiscal_year_start;
            }
        }

        return true;
    }

    public function accountBalance($financial_account_code, $date)
    {
        $AccountBalance = AccountBalance::where('financial_account_code', $financial_account_code)
            ->whereDate('date', '<=', $date)
            ->where('currency', $this->currency)
            ->orderBy('date', 'desc')
            ->first();

        if ($AccountBalance)
        {
            $balance = [
                'debit' => floatval($AccountBalance->debit),
                'credit' => floatval($AccountBalance->credit)
            ];
        }
        else
        {
            $balance = [
                'debit' => 0,
                'credit' => 0
            ];

        }

        return $balance;

    }

    # -- Fetch all the Revenues / Incomes ---
    public function generate()
    {
        $statement = [
            'currency' => $this->currency,
            'assets' => [],
            'liability_and_equity' => [],
            'total_assets' => 0,
            'total_liability_and_equity' => 0,
            'retained_earnings' => 0,
            'balancing_figure' => 0,
            'opening_date' => $this->opening_date,
            'closing_date' => $this->closing_date,
            'profit_and_loss_statement' => [
                'opening_date' => null,
                'closing_date' => null
            ],
        ];

        #Get the Retained Earning


        #Get all the balance sheet account balance
        $query = Account::select(['id', 'code', 'financial_account_category_code', 'name', 'type'])
            ->whereHas('financial_account_category', function ($query) {
                return $query->whereIn('type', ['asset', 'equity', 'liability']);
            })
            ->get();

        $accounts = [];

        foreach ($query as $account)
        {
            $accounts[$account['code']] = [
                'code' => $account->code,
                'financial_account_category_code' => $account->financial_account_category_code,
                'name' => $account->name,
                'type' => $account->financial_account_category->type,
            ];
            $accounts[$account['code']]['sub_accounts'] = [];
        }

        foreach ($accounts as $key => $account)
        {
            $balance = $this->accountBalance($account['code'], $this->closing_date);

            //if ($Account['code'] == 6) MAUpdateLog($Balances); //For debugging

            if (strtolower($account['type']) == 'asset' || strtolower($account['type']) == 'inventory')
            {
                $balance = $balance['debit'] - $balance['credit'];
                $statement['total_assets'] += $balance;
            }
            else
            {
                $balance = $balance['credit'] - $balance['debit'];
                $statement['total_liability_and_equity'] += $balance;
            }

            $accounts[$key]['balance'] = $balance;

            //Clientele & Salesperson balance for relative accounts

            $accounts[$key]['details'] = [];

            //Remove all empty sub accounts
            if (!empty($account['parent_code']) && empty($balance['debit']) && empty($balance['Credit']) && $account['code'] != 9)
            {
                unset($accounts[$key]);
            }

        }

        $parameters = [
            'currency' => $this->currency,
            'opening_date' => $this->opening_date,
            'closing_date' => $this->closing_date,
        ];

        $ProfitAndLoss = new ProfitAndLoss($parameters);

        $profitAndLossStatement = $ProfitAndLoss->generate();

        $retained_earnings = $profitAndLossStatement['net_profit_or_loss'];

        $statement['profit_and_loss_statement']['opening_date'] = $profitAndLossStatement['opening_date'];
        $statement['profit_and_loss_statement']['closing_date'] = $profitAndLossStatement['closing_date'];

        $statement['total_liability_and_equity'] += $retained_earnings;
        $statement['retained_earnings'] = $retained_earnings;

        /*
        //if ($retained_earnings != 0)
        //{
        $accounts[] = [
            'code' => '_retained_earning_',
            'financial_account_category_code' => 9,
            'name' => 'Retained Earnings: From ' . $profitAndLossStatement['opening_date'] . ' to ' . $profitAndLossStatement['closing_date'],
            'balance' => $retained_earnings,
            'details' => [],
            'type' => 'equity'
        ];
        //}
        */


        #Balancing figure
        $statement['balancing_figure'] = $statement['total_assets'] - $statement['total_liability_and_equity'];

        if (abs(round($statement['balancing_figure'], 2)) == 0)
        {
            //do nothing
        }
        else
        {
            $accounts[] = [
                'code' => 0,
                'financial_account_category_code' => 9,
                'name' => 'Balancing Figure',
                'balance' => $statement['balancing_figure'],
                'details' => [],
                'type' => ''
            ];
        }

        $statement['total_liability_and_equity'] += $statement['balancing_figure'];

        #SubAccount Formating
        /*
        foreach ($accounts as $key => $account)
        {
            if (empty($account['parent_code']))
            {
                //do nothing
            }
            else
            {
                //If parent is available Place the sub account under it
                if (isset($accounts[$account['parent_code']]['code']))
                {
                    $accounts[$account['parent_code']]['sub_accounts'][] = $account;
                    unset($accounts[$key]);
                }
            }
        }
        */


        #Remove the empty accounts
        foreach ($accounts as $key => $account)
        {
            if ($account['code'] == 9)
            {
                continue;
            }

            if (empty($account['parent_code']))
            {
                //Means this is a Probable parent account
                if (empty($account['balance']) && empty($account['sub_accounts']))
                {
                    unset($accounts[$key]);
                }
            }
            else
            {
                if (empty($account['balance']))
                {
                    unset($accounts[$key]);
                }
            }

        }

        foreach ($accounts as $key => $account)
        {
            if (strtolower($account['type']) == 'asset' || strtolower($account['type']) == 'inventory')
            {
                $statement['assets'][] = $account;
            }
            else
            {
                $statement['liability_and_equity'][] = $account;
            }
        }

        #Formating for better presentation
        $owners_equity = [];
        foreach ($statement['liability_and_equity'] as $key => $value)
        {
            //Retained Earnings
            if ($value['code'] == 9)
            {
                $owners_equity = $statement['liability_and_equity'][$key];
                unset($statement['liability_and_equity'][$key]);
            }
        }

        if (count($owners_equity) > 0)
        {
            array_push($statement['liability_and_equity'], $owners_equity);
        }

        //echo '<pre>'; print_r($statement); exit;
        return $statement;


    }


}
