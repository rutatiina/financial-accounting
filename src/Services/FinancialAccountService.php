<?php

namespace Rutatiina\FinancialAccounting\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\FinancialAccounting\Models\ContactBalance;
use Rutatiina\FinancialAccounting\Models\FinancialAccountCategory;

class FinancialAccountService
{
    public static $errors = [];

    public static function validate($request)
    {
        $messages = [
            'financial_account_category_code.required' => 'The type field is required.'
        ];

        $rules = [
            'name' => 'required|max:50',
            'code' => 'nullable',
            'financial_account_category_code' => 'required',
            'description' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            self::$errors = $validator->errors()->all();
            return false;
        }

        return true;
    }

    public static function store($request)
    {
        $validate = self::validate($request);

        if (!$validate)
        {
            return false;
        }

        $financialAccountType = FinancialAccountCategory::where('code', $request->financial_account_category_code)->first();

        //get the number if accounts under the type / category
        $count = Account::where('financial_account_category_code', $financialAccountType->code)->count();


        $code = rtrim($financialAccountType->code, "0");
        $code = $code.str_pad((++$count), 2, "0", STR_PAD_LEFT);
        $code = str_pad($code, 6, "0", STR_PAD_RIGHT);

        //print_r($code); exit;

        $Account = new Account;
        $Account->tenant_id = Auth::user()->tenant->id;
        $Account->name = $request->name;
        $Account->code = $code; //$request->code;
        $Account->type = $financialAccountType->type;
        $Account->financial_account_category_code = $request->financial_account_category_code;
        $Account->description = $request->description;
        $Account->payment = $request->payment;

        return $Account->save();
    }

    public static function update($request)
    {

        $validate = self::validate($request);

        if (!$validate)
        {
            return false;
        }

        $financialAccountType = FinancialAccountCategory::where('code', $request->financial_account_category_code)->first();

        $Account = Account::find($request->id);

        $Account->name = $request->name;
        $Account->code = $request->code;
        $Account->type = $financialAccountType->type;
        $Account->financial_account_category_code = $request->financial_account_category_code;
        $Account->description = $request->description;

        return $Account->save();
    }

    public static function destroy($id)
    {
        $financialAccount = Account::find($id);

        //check if the account has any balances
        $balances = AccountBalance::where('financial_account_code', $financialAccount->code)
            ->where(function ($q){
                $q->where('debit', '>', 0);
                $q->orWhere('credit', '>', 0);
            })
            ->count();

        if ($balances > 0)
        {
            self::$errors = ['This account cannot be deleted because of it\'s in use by some transactions.'];
            return false;
        }
        else
        {
            AccountBalance::where('financial_account_code', $financialAccount->code)->delete();
            ContactBalance::where('financial_account_code', $financialAccount->code)->delete();

            return $financialAccount->delete();
        }
    }
}
