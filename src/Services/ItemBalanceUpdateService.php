<?php

namespace Rutatiina\FinancialAccounting\Services;

use Rutatiina\FinancialAccounting\Models\ItemBalance;
use Rutatiina\FinancialAccounting\Models\AccountBalance;

class ItemBalanceUpdateService
{
    public static function entry($data, $reverse = false)
    {
        if (is_object($data))
        {
            $items = $data->items;
        }
        else
        {
            $items = $data['items'];
        }

        if ($reverse && !$data['balances_where_updated'])
        {
            return true;
        }

        if ($reverse)
        {
            foreach ($items as &$item)
            {
                $item['total'] = $item['total'] * -1;
                $item['quantity'] = $item['quantity'] * -1;
            }
            unset($item);
        }

        //Log::info(':: accountBalanceUpdate ------------------------------------------------');

        foreach ($items as $item)
        {
            if (!$item['item_id']) continue;
            
            //note  invoices are made of items BUT payment is for the invoice and thus payment doesn't have the items on it
            $item['financial_account_code'] = $item['debit_financial_account_code'] ?? $item['credit_financial_account_code'];

            if (empty($item['financial_account_code']))
            {
                continue;
            }

            $item['effect'] = (empty($item['debit_financial_account_code'])) ? 'credit' : 'debit';

            //Defaults
            $debit = ($item['effect'] == 'debit') ? $item['total'] : 0;
            $credit = ($item['effect'] == 'credit') ? $item['total'] : 0;

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
                    $debit = $debit * $item['exchange_rate'];
                    $credit = $credit * $item['exchange_rate'];
                }

                $itemBalance = ItemBalance::firstOrCreate(
                    [
                        'tenant_id' => session('tenant_id'),
                        'date' => $data['date'],
                        'currency' => $currency,
                        'financial_account_code' => $item['financial_account_code'],
                        'item_id' => $item['item_id'],
                    ],
                    [
                        'debit' => 0,
                        'credit' => 0,
                        'quantity' => 0
                    ]
                );

                $itemBalance->quantity += $item['quantity'];

                if ($debit) $itemBalance->debit += $debit;
                if ($credit) $itemBalance->credit += $credit;

                $itemBalance->save();

            }

        }

        return true;

    }
}
