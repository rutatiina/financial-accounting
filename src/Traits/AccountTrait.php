<?php

namespace Rutatiina\FinancialAccounting\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\FinancialAccounting\Models\ContactBalance;
use Rutatiina\FinancialAccounting\Models\Account as AccountModel;
use Rutatiina\Contact\Traits\ContactTrait;
use Rutatiina\Tenant\Traits\TenantTrait;
use Rutatiina\Contact\Models\ContactPerson;

trait AccountTrait
{
    //use ContactTrait;
    use TenantTrait;

    protected static $only_instance;
    public static $rg_errors;
    public static $rg_response;

    public static $financial_account_code;
    public static $contact_id;
    public static $currency;
    public static $date;
    public static $dates;
    public static $openingDate;
    public static $closingDate;

    protected static function getSelf()
    {
        if (static::$only_instance === null)
        {
            static::$only_instance = new self;
        }
        return static::$only_instance;
    }

    public static function returnModel()
    {
        return static::$rg_response;
    }

    public static function returnObject()
    {
        return static::$rg_response;
    }

    public static function returnArray()
    {
        return json_decode(json_encode(static::$rg_response), true);
    }

    public static function accountCode($financial_account_code)
    {
        static::$financial_account_code = $financial_account_code;
        return static::getself();
    }

    public static function contactId($contact_id)
    {
        static::$contact_id = $contact_id;
        return static::getself();
    }

    public static function currency($currency)
    {
        static::$currency = $currency;
        return static::getself();
    }

    public static function date($date)
    {
        static::$date = $date;
        return static::getself();
    }

    public static function dates($dates)
    {
        static::$dates = $dates;
        return static::getself();
    }

    public static function openingDate($openingDate)
    {
        static::$openingDate = $openingDate;
        return static::getself();
    }

    public static function closingDate($closingDate)
    {
        static::$closingDate = $closingDate;
        return static::getself();
    }

    public static function balanceByContact($returnModel = false)
	{
        //get the account details
        $account = AccountModel::firstWhere('code', static::$financial_account_code);

        $query = ContactBalance::query();

        $query->where('currency', static::$currency);
		$query->where('financial_account_code', $account->code);
		$query->where('contact_id', static::$contact_id);

        if (empty(static::$date)) {
			//do nothing
        } else {
			$query->where('date', static::$date);
        }

        $query->limit(1);
        $query->orderBy('date', 'DESC');
        $contactBalance = $query->first();

        //var_dump(static::$date); exit;

        //static::$rg_response = $contactBalance;
        //return static::getself();

        if (!$contactBalance) {
            return 0;
        }

        if ($returnModel == true) {
            return $contactBalance;
        }

        //*
        if (in_array($account->type, ['asset','expense','inventory','cost_of_sales','none'])) {
            return ($contactBalance->debit - $contactBalance->credit);
        } elseif (in_array($account->type, ['equity','income','liability'])) {
            return ($contactBalance->credit - $contactBalance->debit);
        } else {
            return false;
        }
        //*/
    }

    public static function balance()
    {
        static::$date       = (empty(static::$date)) ? date('Y-m-d') : static::$date;
        static::$currency   = (empty(static::$currency)) ? Auth::user()->tenant->base_currency : static::$currency;

        $accountBalance = AccountBalance::query();

        $accountBalance->where('date', '<=', static::$date);
        $accountBalance->where('financial_account_code', static::$financial_account_code);
        $accountBalance->where('currency', static::$currency);
        $accountBalance->orderBy('date', 'DESC');
        $accountBalance->limit(1);

        static::$rg_response = $accountBalance->first();
        return static::getself();
    }

    public static function balances()
	{
        $accountBalance = AccountBalance::query();

        if (!empty(static::$dates) && is_array(static::$dates)) {
            $accountBalance->whereIn('date', static::$dates);
        } else {
            $accountBalance->where('date >=', static::$openingDate);
            $accountBalance->where('date <=', static::$closingDate);
        }

        $accountBalance->orderBy('date', 'DESC');
        $accountBalance->where('currency', static::$currency);
        $accountBalance->where('financial_account_code', static::$financial_account_code);

        static::$rg_response = $accountBalance->get();
        return static::getself();

    }

    public static function paymentAccounts()
	{
        $accounts = AccountModel::query();
        $accounts->orderBy('name', 'ASC');
        $accounts->where('payment', 1);

        return $accounts->get();

    }

}
