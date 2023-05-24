<?php

namespace Rutatiina\FinancialAccounting\Services;

use Rutatiina\Tenant\Scopes\TenantIdScope;
use Rutatiina\FinancialAccounting\Models\ContactBalance;

class ContactBalanceUpdateService
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

        foreach ($ledgers as $ledger)
        {
            if (empty($ledger['financial_account_code']))
            {
                return true;
            }

            if (empty($ledger['contact_id']))
            {
                return true;
            }

            //Defaults
            $debit = ($ledger['effect'] == 'debit') ? $ledger['total'] : 0;
            $credit = ($ledger['effect'] == 'credit') ? $ledger['total'] : 0;

            $currencies = [];
            $currencies[$ledger['base_currency']] = $ledger['base_currency'];
            $currencies[$ledger['quote_currency']] = $ledger['quote_currency'];

            foreach ($currencies as $currency)
            {

                if ($currency == $ledger['base_currency'])
                {
                    //Do nothing because the values are in the base currency
                }
                else
                {
                    $debit = $debit * $ledger['exchange_rate'];
                    $credit = $credit * $ledger['exchange_rate'];
                }

                $contactBalance = ContactBalance::withoutGlobalScopes([TenantIdScope::class])
                ->firstOrCreate(
                    [
                        'tenant_id' => $ledger['tenant_id'],
                        'date' => $ledger['date'],
                        'currency' => $currency,
                        'financial_account_code' => $ledger['financial_account_code'],
                        'contact_id' => $ledger['contact_id']
                    ],
                    [
                        'debit' => 0,
                        'credit' => 0,
                    ]
                );

                if ($debit) $contactBalance->debit += $debit;
                if ($credit) $contactBalance->credit += $credit;

                $contactBalance->save();

            }

        }

        return true;

    }

    public static function singleEntry($data, $reverse = false)
    {
        //Defaults
        $total = $data['total'];

        if ($reverse)
        {
            $total = $data['total'] * -1;
        }

        if (empty($data['contact_id']))
        {
            return true;
        }

        $currencies = [];
        $currencies[$data['base_currency']] = $data['base_currency'];
        $currencies[$data['quote_currency']] = $data['quote_currency'];

        foreach ($currencies as $currency)
        {
            if ($currency == $data['base_currency'])
            {
                //Do nothing because the values are in the base currency
            }
            else
            {
                $total = $data['total'] * $data['exchange_rate'];
            }

            //1. find the last record
            $contactBalance = ContactBalance::where('date', '<=', $data['date'])
                //->where('tenant_id', $data['tenant_id']) //TenantIdScope
                ->where('currency', $currency)
                ->where('financial_account_code', $data['financial_account_code'])
                ->where('contact_id', $data['contact_id'])
                ->orderBy('date', 'DESC')
                ->first();

            $contactBalance = ContactBalance::withoutGlobalScopes([TenantIdScope::class])
            ->firstOrCreate(
                [
                    'tenant_id' => $data['tenant_id'],
                    'date' => $data['date'],
                    'currency' => $currency,
                    'financial_account_code' => $data['financial_account_code'],
                    'contact_id' => $data['contact_id']
                ],
                [
                    'debit' => 0,
                    'credit' => 0,
                ]
            );

            $contactBalance->debit += $total;
            $contactBalance->save();

        }

        return true;

    }
}
