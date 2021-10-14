<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Widgets;

use App\Http\Controllers\Controller;
use Rutatiina\FinancialAccounting\Models\Account;

class TotalReceivablesController extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        //get all expense accounts
        $account = Account::find(config('financial-accounting.accounts_receivable_code'));
        if ($account)
        {
            return floatval($account->balance->debit - $account->balance->credit);
        }
        else
        {
            return 0;
        }

    }
}
