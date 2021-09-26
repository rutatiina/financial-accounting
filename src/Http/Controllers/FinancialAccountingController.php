<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers;

use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\FinancialAccounting\Models\Txn;
use Rutatiina\FinancialAccounting\Models\TxnType;
use Rutatiina\Contact\Models\Contact;
use Rutatiina\Item\Models\Item;
use Rutatiina\Tenant\Traits\TenantTrait;
use Rutatiina\FinancialAccounting\Classes\Account as ClassesAccount;
use Rutatiina\FinancialAccounting\Classes\Transaction as TransactionClass;

class FinancialAccountingController extends Controller
{
    use TenantTrait;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('tenant');
    }

    public function accounts()
    {
        return view('accounting::accounts'); //->with([]);
    }

    public function index()
    {

        //load the vue version of the app
        if (!FacadesRequest::wantsJson())
        {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        //var_dump(Auth::user()->tenant); exit;
        //var_dump(Auth::user()->tenant->id); exit;

        //echo 'Accounting > dashboard > we are here'; exit;
        //var_dump($this->uri->segment(1)); exit;


        //Array of past 30 dates
        $dates = [];
        $data_template = [];
        $opening_date = date('Y-m-d', strtotime("-29 days", strtotime('now')));

        $date_period = new \DatePeriod(
            new \DateTime($opening_date),
            new \DateInterval('P1D'),
            new \DateTime(date('Y-m-d', strtotime("+2 day", strtotime('now'))))
        );

        foreach ($date_period as $date)
        {
            $dates[] = $date->format("Y-m-d");
            $data_template[$date->format("Y-m-d")] = 0;
        }

        //print_r($dates); exit;

        $closing_date = end($dates);

        reset($dates); //rewinds array's internal pointer to the first element and returns the value of the first array element.

        //Receviables for past 30 days
        $data_receviables = $data_template;
        $receivables = ClassesAccount::accountCode(1)->dates($dates)->balances()->returnArray();
        $receivables = (empty($receivables)) ? [['date' => date('Y-m-d'), 'debit' => 0, 'credit' => 0]] : $receivables;

        foreach ($receivables as $row)
        {
            $data_receviables[$row['date']] = $row['debit'];
        }

        $balance_receviables = $receivables[(count($receivables) - 1)];
        $balance = $balance_receviables['debit'] + $balance_receviables['credit'];
        if (empty($balance))
        {
            $balance_receviables['percent'] = 0;
        }
        else
        {
            $balance_receviables['percent'] = round(($balance_receviables['credit'] / ($balance_receviables['debit'] + $balance_receviables['credit'])) * 100);
        }
        //print_r($data_receviables); exit;

        //Payables (Supppliers) for past 30 days
        $data_payables = $data_template;
        $payables = ClassesAccount::accountCode(4)->dates($dates)->balances()->returnArray();
        $payables = (empty($payables)) ? [['date' => date('Y-m-d'), 'debit' => 0, 'credit' => 0]] : $payables;

        foreach ($payables as $row)
        {
            $data_payables[$row['date']] = $row['credit'];
        }

        $balance_payables = $payables[(count($payables) - 1)];
        $balance_total = $balance_payables['debit'] + $balance_payables['credit'];

        if (empty($balance_total))
        {
            $balance_payables['percent'] = 0;
        }
        else
        {
            $balance_payables['percent'] = round(($balance_payables['debit'] / ($balance_total)) * 100);
        }

        //print_r($data_payables); exit;
        //print_r($balance_payables); exit;

        //Get the ids of the most active accounts
        $active_accounts = [];
        $accountBalance = AccountBalance::query();
        $accountBalance->where('tenant_id', Auth::user()->tenant->id);
        $accountBalance->where('currency', Auth::user()->tenant->base_currency);
        $accountBalance->orderBy('date', 'DESC');
        $accountBalance->limit(3);

        foreach ($accountBalance->get() as $row)
        {
            $active_accounts[] = $row->financial_account_code;
        }

        //Set the default accounts
        if (empty($active_accounts[0])) $active_accounts[0] = 3; //cash
        if (empty($active_accounts[1])) $active_accounts[1] = 67; //Petty Cash
        if (empty($active_accounts[2])) $active_accounts[2] = 5; //Expense

        //print_r($active_accounts); exit;

        $account_account_balance = [];

        foreach ($active_accounts as $index => $financial_account_code)
        {
            $account_account_balance[$index]['data'] = $data_template;
            $balances = ClassesAccount::accountCode($financial_account_code)->dates($dates)->balances()->returnArray();

            foreach ($balances as $row)
            {
                $account_account_balance[$index]['data'][$row['date']] = $row['debit'] - $row['credit'];
            }

            //Accoung info
            $account_account_balance[$index]['account'] = Account::find($financial_account_code)->toArray();

        }

        foreach ($account_account_balance[2]['data'] as $index => $value)
        {
            $account_account_balance[2]['data'][$index] = array(
                'date' => date('m/d/y', strtotime($index)),
                'alpha' => $value
            );
        }

        //print_r($account_account_balance); exit;

        //Get the number of customers
        $count_customers = (int)Contact::where('categories', 'like', '%customer%')->count();

        //Get the number of suppliers
        $count_suppliers = (int)Contact::where(function ($query)
        {
            $query->where('categories', 'like', '%supplier%')->orWhere('categories', 'like', '%vendor%');
        })->count();

        //Get the number of items
        $count_items = (int)Item::all()->count();

        //Get the number of bill document types
        $bills_txn_types = [];
        $invoice_txn_types = [];
        $txnTypes = TxnType::whereIn('category', ['bill', 'invoice'])->get();
        foreach ($txnTypes as $row)
        {
            if ($row->category == 'bill') $bills_txn_types[] = $row->id;
            if ($row->category == 'invoice') $invoice_txn_types[] = $row->id;
        }

        $txns = Txn::where('tenant_id', Auth::user()->tenant->id)
            ->whereIn('txn_type_id', array_merge($bills_txn_types, $invoice_txn_types))
            //->select('txn_type_id, count(id) as total')
            ->select('txn_type_id', DB::raw('count(id) as total'))
            ->groupBy('txn_type_id')
            ->get();

        $count_bills = 0;
        $count_invoices = 0;
        foreach ($txns as $result)
        {
            if (in_array($result->txn_type_id, $bills_txn_types)) $count_bills += $result->total;
            if (in_array($result->txn_type_id, $invoice_txn_types)) $count_invoices += $result->total;
        }

        //REceviables & payables breakdown
        //Get all the receviables and payables
        $transactions = Txn::where('tenant_id', Auth::user()->tenant->id)
            ->whereIn('txn_type_id', array_merge($bills_txn_types, $invoice_txn_types))
            ->get();
        //where status is unpaid

        //print_r($this->db->last_query()); exit;

        //Receviable current
        $receviable_total = 0;
        $receviable_current = 0;
        $receviable_overdue = 0;
        $payables_total = 0;
        $payables_current = 0;
        $payables_overdue = 0;

        foreach ($transactions as $txn)
        {

            if (in_array($txn->txn_type_id, $invoice_txn_types))
            {
                $receviable_total += $txn->total;
                if (empty($txn->due_date) || strtotime($txn->due_date) >= strtotime('now'))
                {
                    $receviable_current += $txn->total;
                }
                else
                {
                    $receviable_overdue += $txn->total;
                }
            }

            if (in_array($txn->txn_type_id, $bills_txn_types))
            {
                $payables_total += $txn->total;
                if (empty($txn->due_date) || strtotime($txn->due_date) >= strtotime('now'))
                {
                    $payables_current += $txn->total;
                }
                else
                {
                    $payables_overdue += $txn->total;
                }
            }
        }

        //Invoice Aging
        $invoice_aging = array(
            'current' => array('total' => 0, 'outstanding' => 0, 'risk_weight' => 1), //risk_weight = 1
            'lessthan_30_days' => array('total' => 0, 'outstanding' => 0, 'risk_weight' => 2), //risk_weight = 2
            'lessthan_60_days' => array('total' => 0, 'outstanding' => 0, 'risk_weight' => 3), //risk_weight = 3
            'lessthan_90_days' => array('total' => 0, 'outstanding' => 0, 'risk_weight' => 4), //risk_weight = 4
            'over_90_days' => array('total' => 0, 'outstanding' => 0, 'risk_weight' => 5) //risk_weight = 5
        );

        $bill_aging = $invoice_aging;

        foreach ($transactions as $txn)
        {

            $due_date = (empty($txn->due_date)) ? $txn->date_time : $txn->due_date;
            $aging = strtotime('now') - strtotime($due_date);

            if (in_array($txn->txn_type_id, $invoice_txn_types))
            {

                //Get the full transaction details
                $transaction = TransactionClass::transaction($txn);

                if (empty($txn->due_date) || $aging <= 0)
                {
                    $invoice_aging['current']['total'] += $txn->total;
                    $invoice_aging['current']['outstanding'] += $transaction->balance;
                    continue;
                }

                if ($aging <= strtotime('30 days', 0))
                {
                    $invoice_aging['lessthan_30_days']['total'] += $txn->total;
                    $invoice_aging['lessthan_30_days']['outstanding'] += $transaction->balance;
                    continue;
                }

                if ($aging <= strtotime('60 days', 0))
                {
                    $invoice_aging['lessthan_60_days']['total'] += $txn->total;
                    $invoice_aging['lessthan_60_days']['outstanding'] += $transaction->balance;
                    continue;
                }

                if ($aging <= strtotime('90 days', 0))
                {
                    $invoice_aging['lessthan_90_days']['total'] += $txn->total;
                    $invoice_aging['lessthan_90_days']['outstanding'] += $transaction->balance;
                    continue;
                }

                if ($aging > strtotime('90 days', 0))
                {
                    $invoice_aging['over_90_days']['total'] += $txn->total;
                    $invoice_aging['over_90_days']['outstanding'] += $transaction->balance;
                    continue;
                }
            }

            if (in_array($txn->txn_type_id, $bills_txn_types))
            {

                //Get the full transaction details
                $transaction = TransactionClass::transaction($txn);

                if (empty($txn->due_date) || $aging <= 0)
                {
                    $bill_aging['current']['total'] += $txn->total;
                    $bill_aging['current']['outstanding'] += $transaction->balance;
                    continue;
                }

                if ($aging <= strtotime('30 days', 0))
                {
                    $bill_aging['lessthan_30_days']['total'] += $txn->total;
                    $bill_aging['lessthan_30_days']['outstanding'] += $transaction->balance;
                    continue;
                }

                if ($aging <= strtotime('60 days', 0))
                {
                    $bill_aging['lessthan_60_days']['total'] += $txn->total;
                    $bill_aging['lessthan_60_days']['outstanding'] += $transaction->balance;
                    continue;
                }

                if ($aging <= strtotime('90 days', 0))
                {
                    $bill_aging['lessthan_90_days']['total'] += $txn->total;
                    $bill_aging['lessthan_90_days']['outstanding'] += $transaction->balance;
                    continue;
                }

                if ($aging > strtotime('90 days', 0))
                {
                    $bill_aging['over_90_days']['total'] += $txn->total;
                    $bill_aging['over_90_days']['outstanding'] += $transaction->balance;
                    continue;
                }
            }
        }

        //print_r($invoice_aging); exit;

        $business_risk_weight = 0; //Out of 15
        foreach ($invoice_aging as $aging)
        {
            if (empty($aging['total'])) continue;
            $business_risk_weight += (($aging['outstanding'] / $aging['total']) * $aging['risk_weight']);
        }

        $business_risk = ($business_risk_weight / 15);

        //print_r($business_risk); exit;

        $receviable_current_percent = (int)round(@($receviable_current / $receviable_total) * 100);
        $receviable_overdue_percent = (int)round(@($receviable_overdue / $receviable_total) * 100);

        $payables_current_percent = (int)round(@($payables_current / $payables_total) * 100);
        $payables_overdue_percent = (int)round(@($payables_overdue / $payables_total) * 100);

        //Get the the income and expense accounts
        $expense_financial_account_codes = [];
        $revenue_financial_account_codes = [];
        $accounts = Account::whereIn('tenant_id', [0, Auth::user()->tenant->id])->get();
        foreach ($accounts as $account)
        {
            if ($account->type == 'expense') $expense_financial_account_codes[] = $account->code;
            if ($account->type == 'income') $revenue_financial_account_codes[] = $account->code;
        }

        //print_r(implode(',', array_values($revenue_financial_account_codes))); exit;

        $one_year_ago = date('Y-m-01', strtotime('-330 days'));
        $date_period = new \DatePeriod(
            new \DateTime($one_year_ago),
            new \DateInterval('P1D'),
            new \DateTime(date('Y-m-d', strtotime("+2 day", strtotime('now'))))
        );

        $months = [];
        foreach ($date_period as $date)
        {
            //$months[$date->format("Y M")] = $date->format("m");
            $months[$date->format("Y M")] = $date->format("Y M");
        }

        //print_r($months); exit;

        //Set the default values
        $revenues = [];
        $expenses = [];
        foreach ($months as $year_month)
        {
            $revenues[$year_month] = 0;
            $expenses[$year_month] = 0;
        }

        //Get all the monthly incomes for the past one year
        $accountBalance = AccountBalance::query();
        $accountBalance->select('financial_account_code', DB::raw('DATE_FORMAT(`date`,\'%Y %b\') AS `year_month`'), DB::raw('sum(debit) as debit'), DB::raw('sum(credit) as credit'));
        $accountBalance->whereDate('date', '>=', date('Y-m-d', strtotime($one_year_ago)));
        //$accountBalance->where('currency', $this->current_client->currency);
        $accountBalance->whereIn('financial_account_code', array_merge($revenue_financial_account_codes, $expense_financial_account_codes));
        $accountBalance->orderBy('date', 'DESC');
        $accountBalance->groupBy('financial_account_code', DB::raw('YEAR(`date`)'), DB::raw('MONTH(`date`)'));
        $results = $accountBalance->get();

        //print_r($this->db->last_query()); exit; //MONTH(record_date)
        //print_r($results); exit; //MONTH(record_date)

        foreach ($results as $row)
        {
            if (in_array($row->financial_account_code, $revenue_financial_account_codes))
            {
                $revenues[$row->year_month] = $row->credit - $row->debit;
            }

            if (in_array($row->financial_account_code, $expense_financial_account_codes))
            {
                $expenses[$row->year_month] = $row->debit - $row->credit;
            }
        }

        //print_r($revenues); print_r($expenses); exit;

        //var_dump($total_customers); exit;
        //var_dump($receviable_current_percent ); exit;


        return view('accounting::dashboard')->with([
            'invoice_aging' => $invoice_aging,
            'bill_aging' => $bill_aging,

            'business_risk' => $business_risk,

            'revenues' => $revenues, //print_r($revenues); exit;
            'expenses' => $expenses,

            'receviable_total' => $receviable_total,
            'receviable_current' => $receviable_current,
            'receviable_current_percent' => $receviable_current_percent,
            'receviable_overdue_percent' => $receviable_overdue_percent,
            'payables_current_percent' => $payables_current_percent,
            'payables_overdue_percent' => $payables_overdue_percent,
            'receviable_overdue' => $receviable_overdue,
            'payables_total' => $payables_total,
            'payables_current' => $payables_current,
            'payables_overdue' => $payables_overdue,

            'count_customers' => $count_customers,
            'count_suppliers' => $count_suppliers,
            'count_items' => $count_items,
            'count_bills' => $count_bills,
            'count_invoices' => $count_invoices,

            'data_receviables' => $data_receviables,
            'data_payables' => $data_payables,
            'balance_payables' => $balance_payables,
            'balance_receviables' => $balance_receviables,
            'account_accounts' => $account_account_balance,
        ]);

    }
}
