<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Reports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\FinancialAccounting\Models\ContactBalance;
use Rutatiina\FinancialAccounting\Classes\Transaction;
use Rutatiina\Contact\Models\Contact;


class AccountStatementController extends Controller
{

	public $financial_account_code; //account id
	public $openingDate;
	public $closingDate;
	public $currency;

    public function __construct()
    {}

    public function index()
	{
		$accountsGroupByType = Account::all()->groupBy('type');
		$contacts = Contact::all();
        return view('accounting::reports.account-statement.index')->with([
        	'accountsGroupByType' => $accountsGroupByType,
        	'contacts' => $contacts,
		]);
	}

    public function create()
	{}

    public function store(Request $request)
	{}

    public function show($id, Request $request)
	{
		$this->financial_account_code = $id;
		$this->openingDate = ($request->opening_date) ? $request->opening_date : date('Y-m-d', strtotime('-1 years'));
		$this->closingDate = ($request->closing_date) ? $request->closing_date : date('Y-m-d');
		$this->currency = ($request->currency) ? $request->currency : Auth::user()->tenant->base_currency;

		$Account = Account::findOrFail($id);

		$balance = 0;
		$totalDebit = 0;
		$totalCredit = 0;

		//Get the Opening Balance
		$parameters = [
			'financial_account_code' => $id,
			'contact_id' => $request->contact_id,
			'account' => $Account,
			'opening_date' => $this->openingDate,
			'closing_date' => $this->closingDate,
			'currency' => $this->currency,
		];
		$openingBalance = $this->openingBalance($parameters);

		$debitBalance = ['asset','expense','purchase','inventory','cost_of_sales','none'];

		if (in_array($Account->type, $debitBalance)) {
			$balance += ($openingBalance->debit_amount - $openingBalance->credit_amount);
		} else {
			$balance += ($openingBalance->credit_amount - $openingBalance->debit_amount);
		}

		$openingBalanceTxn = (object) [
			'date' => $openingBalance->date,
			'external_date' => null,
			'name' => 'Opening balance',
			'debit_amount' => $openingBalance->debit_amount,
			'credit_amount' => $openingBalance->credit_amount,
			'running_balance' => $balance,
			'id' => 0,
			'double_entry_double' => '',
			'contact' => '',
			'summary' => 'Opening balance',
			'type' => null
		];

		$totalDebit     += $openingBalance->debit_amount;
		$totalCredit    += $openingBalance->credit_amount;

		$parameters = [
            'financial_account_code' => $id,
            'account' => $Account,
            'opening_balance' => $balance,
            'contact_id' => $request->contact_id,
            'opening_date' => $this->openingDate,
            'closing_date' => $this->closingDate,
            'currency' => $this->currency,
        ];

		//return $parameters;

		$Txns = Transaction::statement($parameters);

		if ($Txns == false) {
			//return Transaction::$rg_errors;
		}

		array_unshift($Txns, $openingBalanceTxn); //Add the opening balance txn to begining of txns

		//Get the Closing Balance to verify with accumulated balance value
		$closingBalance = $this->closingBalance($parameters);

		$closingDebit = $closingBalance->debit_amount;
		$closingCredit = $closingBalance->credit_amount;

		if (in_array($Account->type, $debitBalance)) {
			$ClosingTotal = $closingDebit - $closingCredit;
		} else {
			$ClosingTotal = $closingCredit - $closingDebit;
		}

		$Txns[] = (object) [
			'date' => $closingBalance->date,
			'external_date' => null,
			'name' => 'Closing balance',
			'debit_amount' => $closingBalance->debit_amount,
			'credit_amount' => $closingBalance->credit_amount,
			'running_balance' => $ClosingTotal,
			'id' => 0,
			'double_entry_double' => '',
			'contact' => '',
			'summary' => 'Opening balance',
			'type' => null
		];

		//Report Self verification
		$closingDebit   = strval($closingDebit);
		$totalDebit     = strval($totalDebit);
		$closingCredit  = strval($closingCredit);
		$totalCredit    = strval($totalCredit);
		$ClosingTotal   = strval($ClosingTotal);
		$balance        = strval($balance);

		if ( $closingDebit == $totalDebit && $closingCredit == $totalCredit && $ClosingTotal == $balance )
		{
			//All is well
		}
		else
		{
			//Notify the Admin
			$Log = array();
			$Log[] = __METHOD__ . ': Account statement totals not balancing';
			$Log[] = "ClosingDebit : $closingDebit, TotalDebit : $totalDebit";
			$Log[] = "ClosingCredit : $closingCredit, TotalCredit : $totalCredit";
			$Log[] = "ClosingTotal : $ClosingTotal, Balance : $balance";

			//Send Log to Admin
		}

		return view('accounting::reports.account-statement.show')->with([
			'txns' => $Txns,
			'account' => $Account,
			'double_entry_double' => '',
			'debit_amount' => $closingDebit, //$totalDebit,
			'credit_amount' => $closingCredit, //$totalCredit,
			'balance' => $ClosingTotal, //$balance,
			'opening_date' => $this->openingDate,
			'closing_date' => $this->closingDate
		]);

	}

    public function edit($id)
	{}

    public function update(Request $request)
	{}

    public function destroy()
	{}

	//**********************************************************************

	private function openingBalance($parameters)
	{
		$parameters = is_object($parameters) ? $parameters : (object) $parameters;

		//opening balance has its own opening date
		$openingDate = date('Y-m-d', strtotime("yesterday", strtotime($parameters->opening_date)));

		if ($parameters->contact_id) {
			$ContactBalanceQuery = ContactBalance::query();
			$ContactBalanceQuery->select(['date', 'debit as debit_amount', 'credit as credit_amount']);
			$ContactBalanceQuery->where('financial_account_code', $parameters->financial_account_code);
			$ContactBalanceQuery->where('contact_id', $parameters->contact_id);
			$ContactBalanceQuery->where('currency', $parameters->currency);
			$ContactBalanceQuery->whereDate('date', '<=', $openingDate);
			//$ContactBalanceQuery->orderBy('date', 'desc');
			$ContactBalanceQuery->latest('date');
			//$ContactBalanceQuery->limit(1);
			$balance = $ContactBalanceQuery->first();
		} else {
			$AccountBalanceQuery = AccountBalance::query();
			$AccountBalanceQuery->select(['date', 'debit as debit_amount', 'credit as credit_amount']);
			$AccountBalanceQuery->where('financial_account_code', $parameters->financial_account_code);
			$AccountBalanceQuery->where('currency', $parameters->currency);
			$AccountBalanceQuery->whereDate('date', '<=', $openingDate);
			//$AccountBalanceQuery->orderBy('date', 'desc');
			$AccountBalanceQuery->latest('date');
			//$AccountBalanceQuery->limit(1);
			$balance = $AccountBalanceQuery->first();
		}

		if ($balance) {
			return $balance;
		} else {
			return (object) [
				'date' => $openingDate,
				'debit_amount' => 0,
				'credit_amount' => 0
			];
		}
	}

	private function closingBalance($parameters)
	{
		$parameters = is_object($parameters) ? $parameters : (object) $parameters;

		$closingDate = date('Y-m-d', strtotime("tomorrow", strtotime($parameters->closing_date)));

		if ($parameters->contact_id) {
			$ContactBalanceQuery = ContactBalance::query();
			$ContactBalanceQuery->select(['date', 'debit as debit_amount', 'credit as credit_amount']);
			$ContactBalanceQuery->where('financial_account_code', $parameters->financial_account_code);
			$ContactBalanceQuery->where('contact_id', $parameters->contact_id);
			$ContactBalanceQuery->where('currency', $parameters->currency);
			$ContactBalanceQuery->whereDate('date', '<=', $closingDate);
			$ContactBalanceQuery->latest('date');
			//$ContactBalanceQuery->orderBy('date', 'asc');
			$balance = $ContactBalanceQuery->first();
		} else {
			$AccountBalanceQuery = AccountBalance::query();
			$AccountBalanceQuery->select(['date', 'debit as debit_amount', 'credit as credit_amount']);
			$AccountBalanceQuery->where('financial_account_code', $parameters->financial_account_code);
			$AccountBalanceQuery->where('currency', $parameters->currency);
			$AccountBalanceQuery->whereDate('date', '<=', $closingDate);
			$AccountBalanceQuery->latest('date');
			//$AccountBalanceQuery->orderBy('date', 'asc');
			$balance = $AccountBalanceQuery->first();
		}

		//var_dump($AccountBalance->credit); exit;

		if ($balance) {
			return $balance;
		} else {
			return (object) [
				'date' => $parameters->closing_date,
				'debit_amount' => 0,
				'credit_amount' => 0
			];
		}

	}
}
