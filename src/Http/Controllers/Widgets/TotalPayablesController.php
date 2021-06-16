<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Widgets;

use App\Http\Controllers\Controller;
use Rutatiina\FinancialAccounting\Models\Account;

class TotalPayablesController extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        //get all expense accounts
        $account = Account::findCode(4);

        return floatval($account->balance->credit - $account->balance->debit);

    }
}
