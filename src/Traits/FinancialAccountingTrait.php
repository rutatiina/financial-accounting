<?php

namespace Rutatiina\FinancialAccounting\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\Tax\Models\Tax;
use Rutatiina\Tenant\Traits\TenantTrait;

trait FinancialAccountingTrait
{
    //todo #rutatiina this method bellow is to be deleted
    public function documentNumber($entree, $model)
    {
        if ($model) {
            $n = str_pad(($model->number+1), $entree->document->settings->number_length, "0", STR_PAD_LEFT);
        } else {
            $n = str_pad(1, $entree->document->settings->number_length, "0", STR_PAD_LEFT);
        }

        return $entree->document->settings->number_prefix . $n . $entree->document->settings->number_postfix;
    }

    public static function accounts()
    {
        return Account::all();
    }

    public static function taxes()
    {
        return Tax::orderBy('display_name', 'asc')->get();
    }

    public static function bankAccounts()
    {
        return []; //Account::all();
    }

}
