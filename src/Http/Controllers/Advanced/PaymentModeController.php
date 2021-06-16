<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Advanced;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentModeController extends Controller
{
    public function __construct()
    {}

    public function index()
	{
	    $modes = [
	        ['value' => 'Bank Deposit', 'text' => 'Bank Deposit'],
            ['value' => 'Bank Remittance', 'text' => 'Bank Remittance'],
            ['value' => 'Bank Transfer', 'text' => 'Bank Transfer'],
            ['value' => 'Cash', 'text' => 'Cash'],
            ['value' => 'Check', 'text' => 'Check'],
            ['value' => 'Credit Card', 'text' => 'Credit Card'],
            ['value' => 'Mobile money', 'text' => 'Mobile money']
        ];

	    return $modes;
    }

    public function create(Request $request)
	{}

    public function store(Request $request)
	{}

    public function show($id)
	{}

    public function edit($id)
	{}

    public function update(Request $request)
	{}

    public function destroy($id)
	{}
}
