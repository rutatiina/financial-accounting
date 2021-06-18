<?php

namespace Rutatiina\FinancialAccounting\Services;

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

                //1. find the last record
                $contactBalance = ContactBalance::where('date', '<=', $ledger['date'])
                    //->where('tenant_id', $ledger['tenant_id']) //TenantIdScope
                    ->where('currency', $currency)
                    ->where('financial_account_code', $ledger['financial_account_code'])
                    ->where('contact_id', $ledger['contact_id'])
                    ->orderBy('date', 'DESC')
                    ->first();

                //var_dump($contactBalance->num_rows()); exit;

                switch ($contactBalance)
                {
                    case null:

                        //create a new balance record
                        $contactBalanceInsert = new ContactBalance;
                        $contactBalanceInsert->tenant_id = $ledger['tenant_id'];
                        $contactBalanceInsert->contact_id = $ledger['contact_id'];
                        $contactBalanceInsert->date = $ledger['date'];
                        $contactBalanceInsert->financial_account_code = $ledger['financial_account_code'];
                        $contactBalanceInsert->currency = $currency;
                        $contactBalanceInsert->debit = 0;
                        $contactBalanceInsert->credit = 0;
                        $contactBalanceInsert->save();

                        break;

                    default:

                        //create a new row with the last balances
                        if ($ledger['date'] == $contactBalance->date)
                        {
                            //do nothing because the records for this dates balances already exists
                        }
                        else
                        {
                            $contactBalanceInsert = new ContactBalance;
                            $contactBalanceInsert->tenant_id = $ledger['tenant_id'];
                            $contactBalanceInsert->contact_id = $ledger['contact_id'];
                            $contactBalanceInsert->date = $ledger['date'];
                            $contactBalanceInsert->financial_account_code = $ledger['financial_account_code'];
                            $contactBalanceInsert->currency = $currency;
                            $contactBalanceInsert->debit = $contactBalance->debit;
                            $contactBalanceInsert->credit = $contactBalance->credit;
                            $contactBalanceInsert->save();
                        }

                        break;
                }

                if ($debit)
                {

                    $increment = ContactBalance::where('date', '>=', $ledger['date'])
                        ->where('currency', $currency)
                        ->where('financial_account_code', $ledger['financial_account_code'])
                        ->where('contact_id', $ledger['contact_id'])
                        ->increment('debit', $debit);

                }
                elseif ($credit)
                {

                    $increment = ContactBalance::where('date', '>=', $ledger['date'])
                        ->where('currency', $currency)
                        ->where('financial_account_code', $ledger['financial_account_code'])
                        ->where('contact_id', $ledger['contact_id'])
                        ->increment('credit', $credit);

                }

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

            //var_dump($contactBalance->num_rows()); exit;

            switch ($contactBalance)
            {
                case null:

                    //create a new balance record
                    $contactBalanceInsert = new ContactBalance;
                    $contactBalanceInsert->tenant_id = $data['tenant_id'];
                    $contactBalanceInsert->contact_id = $data['contact_id'];
                    $contactBalanceInsert->date = $data['date'];
                    $contactBalanceInsert->financial_account_code = $data['financial_account_code'];
                    $contactBalanceInsert->currency = $currency;
                    $contactBalanceInsert->debit = 0;
                    $contactBalanceInsert->credit = 0;
                    $contactBalanceInsert->save();

                    break;

                default:

                    //create a new row with the last balances
                    if ($data['date'] == $contactBalance->date)
                    {
                        //do nothing because the records for this dates balances already exists
                    }
                    else
                    {
                        $contactBalanceInsert = new ContactBalance;
                        $contactBalanceInsert->tenant_id = $data['tenant_id'];
                        $contactBalanceInsert->contact_id = $data['contact_id'];
                        $contactBalanceInsert->date = $data['date'];
                        $contactBalanceInsert->financial_account_code = $data['financial_account_code'];
                        $contactBalanceInsert->currency = $currency;
                        $contactBalanceInsert->debit = $contactBalance->debit;
                        $contactBalanceInsert->credit = $contactBalance->credit;
                        $contactBalanceInsert->save();
                    }

                    break;
            }

            ContactBalance::where('date', '>=', $data['date'])
                ->where('currency', $currency)
                ->where('financial_account_code', $data['financial_account_code'])
                ->where('contact_id', $data['contact_id'])
                ->increment('debit', $total);

        }



        return true;

    }
}
