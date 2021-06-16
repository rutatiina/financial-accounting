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
        $account = Account::find(1);
        return floatval($account->balance->debit - $account->balance->credit);

    }
}
