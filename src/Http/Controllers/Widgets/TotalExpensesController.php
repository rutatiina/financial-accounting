<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Widgets;

use App\Http\Controllers\Controller;
use Rutatiina\FinancialAccounting\Models\Account;

class TotalExpensesController extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        //get all expense accounts
        $expenseAccounts = Account::where('type', 'expense')
            ->whereNotIn('code', [720100]) //exclude the cost of sales expense account - 720100 code
            ->get();

        $total = 0;

        foreach ($expenseAccounts as $account) {
            $total += ($account->balance->debit - $account->balance->credit);
        }

        return floatval($total);

    }
}
