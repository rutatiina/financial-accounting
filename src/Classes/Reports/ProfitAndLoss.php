<?php

namespace Rutatiina\FinancialAccounting\Classes\Reports;

use Illuminate\Support\Facades\Auth;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\FinancialAccounting\Models\AccountBalance;

class ProfitAndLoss
{
    public $tenant = null;
    public $opening_date = null; //date('Y-m-d');
    public $closing_date = null;
    public $currency = 'UGX';

    //--------------------------------------------------------------------------
    public function __construct($parameters) 
    {
        //ini_set('memory_limit', '-1M');
        $this->tenant   = Auth::user()->tenant;
        $this->opening_date = (isset($parameters['opening_date'])) ? $parameters['opening_date'] : date('Y-m-d', strtotime('-1 years'));
        $this->closing_date = (isset($parameters['closing_date'])) ? $parameters['closing_date'] : date('Y-m-d');
        $this->currency = (isset($parameters['currency'])) ? $parameters['currency'] : Auth::user()->tenant->base_currency;
    }
		
    public function opening_date()
    {            
        $fiscal_year_start = $this->tenant->fiscal_year_start; // m-d
        //Determine start of accounting year
        
        $today = strtotime('now');
        $last_year = date('Y') - 1;
        
        //Find the begining of the account year based on the Closing date
        if ( strtotime($this->closing_date) >= strtotime(date('Y-') . $fiscal_year_start))
        {
            $fiscal_year_opening_date = date('Y-') . $fiscal_year_start;
        }
        else
        {
            $fiscal_year_opening_date = $last_year . '-' . $fiscal_year_start;
        }
        
        //echo $this->opening_date . ' vs ' . date('Y-') . $fiscal_year_start;
        
        if ( strtotime($this->opening_date) >= strtotime(date('Y-') . $fiscal_year_start))
        {
            //Do nothing
        }
        else
        {
            //If the opening date false in another financila year - limit it to the year based on closing date
            if ( strtotime($this->opening_date) < strtotime($fiscal_year_opening_date))
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

        if ($AccountBalance) {
            $balance = [
                'debit'     => floatval($AccountBalance->debit),
                'credit'    => floatval($AccountBalance->credit)
            ];
        } else {
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
        $statement = array(
            'currency' => $this->currency,
            'incomes' => [],
            'expenses' => [],
            'cost_of_sales' => [],
            'gross_profit_or_loss' => 0,
            'net_profit_or_loss' => 0,
            'total_income' => 0,
            'total_cost_of_sales' => 0,
            'total_expense' => 0,
            'opening_date' => $this->opening_date,
            'closing_date' => $this->closing_date,
        );

        //Determine and set the correct opening date
        $this->opening_date();

        #Get all the Income statement account balances
        $AccountModel = Account::select(['id', 'code', 'financial_account_category_code', 'name','type'])
            ->whereHas('financial_account_category', function ($query) {
                return $query->whereIn('type', ['revenue', 'expense']);
            })
            ->get();

        $accounts = [];
        
        foreach($AccountModel as $index => $account)
        {
            $accounts[$account->code] = [
            	'code' => $account->code,
            	'financial_account_category_code' => $account->financial_account_category_code,
            	'name' => $account->name,
            	'type' => $account->financial_account_category->type,
			];
            $accounts[$account->code]['sub_accounts'] = [];

            $accounts[$account->code]['balance_account'] = 0;
            $accounts[$account->code]['balance_sub_accounts'] = 0;
            $accounts[$account->code]['balance_total'] = 0;
        }

        //print_r($accounts); exit;
        
        foreach($accounts as $key => $account)
        {
            $opening_date = date('Y-m-d', strtotime("yesterday", strtotime($this->opening_date)));

            $opening = $this->accountBalance($account['code'], $opening_date);

            $closing = $this->accountBalance($account['code'], $this->closing_date);
            
            //exit;
            
            $balances = [
                'debit'     => $closing['debit'] - $opening['debit'],
                'credit'    => $closing['credit'] - $opening['credit']
            ];
            
            //var_dump($balances); exit;

            if (strtolower($account['type']) == 'expense')
            {
                $balance = $balances['debit'] - $balances['credit'];
                $statement['total_expense'] += $balance;
            }
            elseif (strtolower($account['type']) == 'revenue')
            {
                $balance = $balances['credit'] - $balances['debit'];
                $statement['total_income'] += $balance;
            }
            
            $accounts[$key]['balance_account'] = floatval($balance);
            $accounts[$key]['balance_total'] = floatval($balance);
        }

        #set the balance_total and balance_subaccounts
        /*
        foreach($accounts as $key => $account)
        {
            if (empty($account['parent_code']))
            {
                //do nothing
            }
            else
            {
                $accounts[$account['parent_code']]['balance_sub_accounts'] += $account['balance_account'];
                $accounts[$account['parent_code']]['balance_total'] += $account['balance_account'];
            }                    
        }
        */

        //print_r($accounts); exit;

        //delete empty accounts
        foreach($accounts as $key => $account)
        {
            if (empty($account['balance_total']))
            {
                unset($accounts[$key]);
            }
        }


        #Sub_account Formating
        /*
        foreach($accounts as $key => $account)
        {
            if (empty($account['parent_code'])) {
                //do nothing
            } else {
            	//var_dump($account->code); exit;
                $accounts[$account['parent_code']]['sub_accounts'][$account['code']] = (object) $account;
                unset($accounts[$key]);
            }                    
        }
        */

        //print_r($accounts); exit;
        foreach($accounts as $key => $account)
        {
            if (strtolower($account['type']) == 'expense' && strtolower($account['sub_type']) != 'cost-of-sales')
            {
                $statement['expenses'][$account['code']] = (object) $account;
            }
            elseif (strtolower($account['type']) == 'revenue')
            {
                $statement['incomes'][$account['code']] = (object) $account;
            }
            elseif (strtolower($account['type']) == 'expense' && strtolower($account['sub_type']) == 'cost-of-sales')
            {
                $statement['CostOfSales'][$account['code']] = (object) $account;
            }
        }

        #Gross / Net profit / loss
        $statement['gross_profit_or_loss'] = $statement['total_income'] - $statement['total_cost_of_sales'];
        $statement['net_profit_or_loss'] = $statement['gross_profit_or_loss'] - $statement['total_expense'];
        //echo '<pre>'; print_r($statement); exit;
        return $statement;
        
        
    }

}
