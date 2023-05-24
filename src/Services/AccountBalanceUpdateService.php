<?php

namespace Rutatiina\FinancialAccounting\Services;

use Rutatiina\Tenant\Scopes\TenantIdScope;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\FinancialAccounting\Models\AccountDailyBalance;

class AccountBalanceUpdateService
{
    public static function doubleEntry($data, $reverse = false)
    {
        if (is_object($data))
        {
            $ledgers = $data->ledgers;
        }
        else
        {
            $ledgers = $data['ledgers'];
        }

        if ($reverse && !$data['balances_where_updated'])
        {
            return true;
        }

        if ($reverse)
        {
            foreach ($ledgers as &$ledger)
            {
                $ledger['total'] = $ledger['total'] * -1;
            }
            unset($ledger);
        }

        //Log::info(':: accountBalanceUpdate ------------------------------------------------');

        foreach ($ledgers as $ledger)
        {
            if (empty($ledger['financial_account_code']))
            {
                continue;
            }

            //Defaults
            $debit = ($ledger['effect'] == 'debit') ? $ledger['total'] : 0;
            $credit = ($ledger['effect'] == 'credit') ? $ledger['total'] : 0;

            $currencies = [];
            $currencies[$ledger['base_currency']] = $ledger['base_currency'];
            $currencies[$ledger['quote_currency']] = $ledger['quote_currency'];

            foreach ($currencies as $currency)
            {
                //for multi-currency, apply the exchange rate
                if ($currency == $ledger['base_currency'])
                {
                    //Do nothing because the values are in the base currency
                }
                else
                {
                    $debit = $debit * $ledger['exchange_rate'];
                    $credit = $credit * $ledger['exchange_rate'];
                }

                //1. find the last record
                $accountBalance = AccountBalance::withoutGlobalScopes([TenantIdScope::class])
                ->firstOrCreate(
                    [
                        'tenant_id' => $ledger['tenant_id'],
                        'date' => $ledger['date'],
                        'currency' => $currency,
                        'financial_account_code' => $ledger['financial_account_code'],
                    ],
                    [
                        'debit' => 0,
                        'credit' => 0,
                    ]
                );

                if ($debit) $accountBalance->debit += $debit;
                if ($credit) $accountBalance->credit += $credit;

                $accountBalance->save();

                //2. find the record for daily balance for that date
                $accountDailyBalance = AccountDailyBalance::withoutGlobalScopes([TenantIdScope::class])
                ->firstOrCreate(
                    [
                        'tenant_id' => $ledger['tenant_id'],
                        'date' => $ledger['date'],
                        'currency' => $currency,
                        'financial_account_code' => $ledger['financial_account_code'],
                    ],
                    [
                        'debit' => 0,
                        'credit' => 0,
                    ]
                );

                if ($debit) $accountDailyBalance->debit += $debit;
                if ($credit) $accountDailyBalance->credit += $credit;

                $accountDailyBalance->save();

            }

        }

        return true;

    }

    public static function singleEntry($data, $reverse = false)
    {
        if ($reverse && !$data['balances_where_updated'])
        {
            return true;
        }

        //Defaults
        $total = $data['total'];

        if ($reverse)
        {
            $total = $data['total'] * -1;
        }

        $currencies = [];
        $currencies[$data['base_currency']] = $data['base_currency'];
        $currencies[$data['quote_currency']] = $data['quote_currency'];

        foreach ($currencies as $currency)
        {
            //for multi-currency, apply the exchange rate
            if ($currency == $data['base_currency'])
            {
                //Do nothing because the values are in the base currency
            }
            else
            {
                $total = $data['total'] * $data['exchange_rate'];
            }

            //1. find the last record
            $accountBalance = AccountBalance::whereDate('date', '<=', $data['date'])
                ->where('currency', $currency)
                ->where('financial_account_code', $data['financial_account_code'])
                ->orderBy('date', 'desc')
                ->first();

            //2. find the daily account daily balance record
            AccountDailyBalance::firstOrCreate([
                'tenant_id' => $data['tenant_id'],
                'date' => $data['date'],
                'currency' => $currency,
                'financial_account_code' => $data['financial_account_code']
            ]);

            //var_dump($accountBalance); exit;
            //Log::info('>>Last account balance entry for account id::'.$data['financial_account_code'].' in '.$currency.' date: '.$data['date'].': '.$data['effect'].' '.$data['total']);
            //Log::info($data);
            //Log::info($accountBalance);

            switch ($accountBalance)
            {
                case null:

                    //create a new balance record
                    $account_balance = new AccountBalance;
                    $account_balance->tenant_id = $data['tenant_id'];
                    $account_balance->date = $data['date'];
                    $account_balance->financial_account_code = $data['financial_account_code'];
                    $account_balance->currency = $currency;
                    $account_balance->debit = 0;
                    $account_balance->credit = 0;
                    $account_balance->save();

                    break;

                default:

                    //create a new row with the last balances
                    if ($data['date'] == $accountBalance->date)
                    {
                        //do nothing because the records for this dates balances already exists
                    }
                    else
                    {
                        $account_balance = new AccountBalance;
                        $account_balance->tenant_id = $data['tenant_id'];
                        $account_balance->date = $data['date'];
                        $account_balance->financial_account_code = $data['financial_account_code'];
                        $account_balance->currency = $currency;
                        $account_balance->debit = $accountBalance->debit;
                        $account_balance->credit = $accountBalance->credit;
                        $account_balance->save();
                    }

                    break;
            }

            AccountBalance::whereDate('date', '>=', $data['date'])
                ->where('currency', $currency)
                ->where('financial_account_code', $data['financial_account_code'])
                ->increment('debit', $total);
            //Log::info('debit increment: '.$total);
            //Log::info($increment);

            AccountDailyBalance::whereDate('date', $data['date'])
                ->where('currency', $currency)
                ->where('financial_account_code', $data['financial_account_code'])
                ->increment('debit', $total);
        }

        return true;
    }
}
