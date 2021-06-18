<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers;

use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;
use Rutatiina\Bill\Models\Bill;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\FinancialAccounting\Models\ContactBalance;
use Rutatiina\Invoice\Models\Invoice;
use Rutatiina\SalesOrder\Models\SalesOrder;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\Contact\Models\Contact;
use Rutatiina\Item\Models\Item;


class DashboardController extends Controller
{
    public function __construct()
    {}

    public function index()
	{
        if (FacadesRequest::wantsJson()) {
            return Account::paginate(20);
        }
	}

    public function invoicesSummary()
	{
	    $count = Invoice::count();
	    $pending = Invoice::where('status', 'Pending')->count();
	    $fullyPaid = Invoice::whereColumn('total', 'total_paid')->count();

        if($count) {
            $percentagePaid = ($fullyPaid / $count);
        } else {
            $percentagePaid = 0;
        }

	    $data = [
	        'count' => $count,
	        'pending' => $pending,
	        'fullyPaid' => $fullyPaid,
	        'percentagePaid' => $percentagePaid,
        ];
	    return $data;
    }

    public function billsSummary()
	{
        $count = Bill::count();
        $pending = Bill::where('status', 'Pending')->count();
        $fullyPaid = Bill::whereColumn('total', 'total_paid')->count();

        if($count) {
            $percentagePaid = ($fullyPaid / $count);
        } else {
            $percentagePaid = 0;
        }

        $data = [
            'count' => $count,
            'pending' => $pending,
            'fullyPaid' => $fullyPaid,
            'percentagePaid' => $percentagePaid,
        ];
        return $data;
    }

    public function dataCount()
	{
	    $customers = Contact::where('types', 'like', '%customer%')->count();
	    $suppliers = Contact::where('types', 'like', '%supplier%')->count();
	    $items = Item::count();
	    $invoices = Invoice::count();
	    $bills = Bill::count();
	    $orders = SalesOrder::count();

        return [
            'customers' => $customers,
            'suppliers' => $suppliers,
            'items' => $items,
            'invoices' => $invoices,
            'bills' => $bills,
            'orders' => $orders,
        ];
    }

    public function incomesAndExpense(Request $request)
    {
        $tenant = Auth::user()->tenant;

        $one_year_ago = date('Y-m-01', strtotime('-330 days'));
        $date_period = new \DatePeriod(
            new \DateTime($one_year_ago),
            new \DateInterval('P1D'),
            new \DateTime(date('Y-m-d', strtotime("+2 day", strtotime('now'))))
        );

        $months = [];

        foreach($date_period as $date){
            //$months[$date->format("Y M")] = $date->format("m");
            $months[$date->format("Y M")] = $date->format("Y M");
        }

        //print_r($months); exit;

        //Set the default values
        $revenues = [];
        $expenses = [];
        foreach($months as $year_month)
        {
            $revenues[$year_month] = 0;
            $expenses[$year_month] = 0;
        }

        //Get the the income and expense accounts
        $expense_financial_account_codes = [];
        $revenue_financial_account_codes = [];
        $accounts = Account::whereIn('tenant_id', [0, $tenant->id])->get();
        foreach($accounts as $account)
        {
            if ($account->type == 'expense') $expense_financial_account_codes[] = $account->code;
            if ($account->type == 'income') $revenue_financial_account_codes[] = $account->code;
        }

        //Get all the monthly incomes for the past one year
        if ($request->contact)
        {
            $accountBalance = ContactBalance::query();
            $accountBalance->select('financial_account_code', DB::raw('DATE_FORMAT(`date`,\'%Y %b\') AS `year_month`'), DB::raw('sum(debit) as debit'), DB::raw('sum(credit) as credit'));
            $accountBalance->where('contact_id', $request->contact);
            $accountBalance->whereDate('date', '>=', date('Y-m-d', strtotime($one_year_ago)));
            $accountBalance->whereDate('date', '<=', date('Y-m-d'));
            $accountBalance->where('currency', $tenant->base_currency);
            $accountBalance->whereIn('financial_account_code', array_merge($revenue_financial_account_codes, $expense_financial_account_codes));
            $accountBalance->orderBy('date', 'DESC');
            $accountBalance->groupBy(['financial_account_code', DB::raw('YEAR(`date`)'), DB::raw('MONTH(`date`)')]);
            $results = $accountBalance->get();
        }
        else
        {
            $accountBalance = AccountBalance::query();
            $accountBalance->select('financial_account_code', DB::raw('DATE_FORMAT(`date`,\'%Y %b\') AS `year_month`'), DB::raw('sum(debit) as debit'), DB::raw('sum(credit) as credit'));
            $accountBalance->whereDate('date', '>=', date('Y-m-d', strtotime($one_year_ago)));
            $accountBalance->whereDate('date', '<=', date('Y-m-d'));
            $accountBalance->where('currency', $tenant->base_currency);
            $accountBalance->whereIn('financial_account_code', array_merge($revenue_financial_account_codes, $expense_financial_account_codes));
            $accountBalance->orderBy('date', 'DESC');
            $accountBalance->groupBy(['financial_account_code', DB::raw('YEAR(`date`)'), DB::raw('MONTH(`date`)')]);
            $results = $accountBalance->get();
        }

        //print_r($this->db->last_query()); exit; //MONTH(record_date)
        //print_r($results); exit; //MONTH(record_date)

        foreach ($results as $row) {
            if (in_array($row->financial_account_code, $revenue_financial_account_codes)) {
                $revenues[$row->year_month] = ($row->credit - $row->debit);
            }

            if (in_array($row->financial_account_code, $expense_financial_account_codes)) {
                $expenses[$row->year_month] = ($row->debit - $row->credit);
            }
        }

        $revenuesValues = array_values($revenues);
        $expensesValues = array_values($expenses);

        $revenuesAndExpenses = array_merge($revenuesValues, $expensesValues);

        $apexChart = [];
        $apexChart['series'] = [
            [
                'name' => "Revenues",
                'data' => $revenuesValues
            ],
            [
                'name' => "Expenses",
                'data' => $expensesValues
            ]
        ];

        $apexChart['chartOptions'] = [
            'chart' => [
                'fontFamily' => '',
                'shadow' => [
                    'enabled' => true,
                    'color' => '#000',
                    'top' => 18,
                    'left' => 7,
                    'blur' => 10,
                    'opacity' => 1
                ],
                'toolbar' => [
                    'show' => false
                ]
            ],
            'colors' => ['#77B6EA', '#545454'],
            'dataLabels' => [
                'enabled' => true,
            ],
            'stroke' => [
                'curve' => 'smooth'
            ],
            'title' => [
                'text' => 'Incomes and Expenses for the past year',
                'align' => 'left'
            ],
            'grid' => [
                'borderColor' => '#e7e7e7',
                'row' => [
                    'colors' => ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    'opacity' => 0.5
                ],
            ],
            'markers' => [
                'size' => 6
            ],
            'xaxis' => [
                'categories' => array_values($months),
                'title' => [
                    'text' => 'Month'
                ],
                'labels' => [
                    'formatter' => []
                ]
            ],
            'yaxis' => [
                'show' => false,
                'forceNiceScale' => true,
                'title' => [
                    'text' => 'Amount'
                ],
                'min' => min($revenuesAndExpenses),
                'max' => max($revenuesAndExpenses),
                'type' => 'numeric',
                'labels' => [
                    'formatter' => []
                ]
            ],
            'legend' => [
                'position' => 'top',
                'horizontalAlign' => 'right',
                'floating' => true,
                'offsetY' => -25,
                'offsetX' => -5
            ]
        ];

        return $apexChart;

    }

    public  function businessRisk() {}

}
