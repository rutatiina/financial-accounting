<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Widgets;

use App\Http\Controllers\Controller;
use Rutatiina\FinancialAccounting\Models\Account;

class TotalIncomeController extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        //get all expense accounts
        $incomeAccounts = Account::where('type', 'revenue')->get();

        $total = 0;

        foreach ($incomeAccounts as $account) {
            $total += ($account->balance->credit - $account->balance->debit);
        }

        return floatval($total);

    }
}
