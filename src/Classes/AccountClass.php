<?php

namespace Rutatiina\FinancialAccounting\Classes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rutatiina\FinancialAccounting\Traits\AccountTrait;

class AccountClass
{
    use AccountTrait;

    public function __construct()
    {}
}
