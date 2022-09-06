<?php

namespace Rutatiina\FinancialAccounting\Seeders;

use Illuminate\Database\Seeder;
use Rutatiina\Bill\Models\Bill;
use Rutatiina\Bill\Models\BillItem;
use Rutatiina\Sales\Models\Sales;
use Rutatiina\POS\Models\POSOrder;
use Rutatiina\Expense\Models\Expense;
use Rutatiina\Invoice\Models\Invoice;
use Rutatiina\DebitNote\Models\DebitNote;
use Rutatiina\Tenant\Scopes\TenantIdScope;
use Rutatiina\CreditNote\Models\CreditNote;
use Rutatiina\PaymentMade\Models\PaymentMade;
use Rutatiina\JournalEntry\Models\JournalEntry;
use Rutatiina\PaymentReceived\Models\PaymentReceived;
use Rutatiina\RetainerInvoice\Models\RetainerInvoice;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\FinancialAccounting\Models\FinancialAccountLedger;

//php artisan db:seed --class=\\Rutatiina\\FinancialAccounting\\Seeders\\FinancialAccountLedgerSeeder
//php artisan db:seed --class=\Rutatiina\FinancialAccounting\Seeders\FinancialAccountLedgerSeeder

class FinancialAccountLedgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountBalance::truncate();
        FinancialAccountLedger::truncate();

        BillItem::withoutGlobalScopes([TenantIdScope::class])
            ->where('id', '>', 0)
            ->update(['debit_financial_account_code' => 720100]);
        
        //update the summaries & account ledger table
        //bills
        //cash sales
        //credit notes
        //debit notes
        //expenses
        //invoice
        //journal enties
        //payment received
        //payment made
        //pos order
        //receipts
        //retainer invoice
        //sales

        $classes = [
            'bill_id' => Bill::class,
                //CashSaleLedger::class,
            'credit_note_id' => CreditNote::class,
            'debit_note_id' => DebitNote::class,
            'expense_id' => Expense::class,
            'invoice_id' => Invoice::class,
                // 'journal_entry_id' => JournalEntry::class,
            'payment_received_id' => PaymentReceived::class,
            'payment_made_id' => PaymentMade::class,
            'pos_order_id' => POSOrder::class,
            'retainer_invoice_id' => RetainerInvoice::class,
            'sales_id' => Sales::class
        ];

        $this->command->line('* Time to work margic');

        foreach($classes as $key_name => $class)
        {
            $txns = (new $class)->withoutGlobalScopes([TenantIdScope::class])
                ->with(['items' => function ($query) {
                    $query->withoutGlobalScopes();
                }])
                ->get();

            foreach ($txns as $key => $txn) 
            {

                $data = $txn->toArray();
                $data['ledgers'] = [];
                $_creditAccount = 0;
                $_debitAccount = 0;
                
                foreach ($txn->items as $key => $item)
                {
                    $itemTaxableAmount   = ($item->rate*$item->quantity);

                    if ( isset($item->debit_financial_account_code) && !empty($item->debit_financial_account_code))
                    {
                        $_debitAccount = $item->debit_financial_account_code;
                        $data['ledgers'][$_debitAccount]['financial_account_code'] = $_debitAccount;
                        $data['ledgers'][$_debitAccount]['effect'] = 'debit';
                        $data['ledgers'][$_debitAccount]['total'] = @$data['ledgers'][$_debitAccount]['total'] + $itemTaxableAmount;
                        $data['ledgers'][$_debitAccount]['contact_id'] = $data['contact_id'];
                    }
                    elseif (isset($item->credit_financial_account_code) && !empty($item->credit_financial_account_code))
                    {
                        $_creditAccount = $item->credit_financial_account_code;
                        $data['ledgers'][$_creditAccount]['financial_account_code'] = $_creditAccount;
                        $data['ledgers'][$_creditAccount]['effect'] = 'credit';
                        $data['ledgers'][$_creditAccount]['total'] = @$data['ledgers'][$_creditAccount]['total'] + $itemTaxableAmount;
                        $data['ledgers'][$_creditAccount]['contact_id'] = $data['contact_id'];
                    }
                    else
                    {
                        continue;
                    }
                }

                if ($_debitAccount)
                {
                    $_creditAccount = $txn->credit_financial_account_code;
                    $data['ledgers'][$txn->credit_financial_account_code] = [
                        'financial_account_code' => $txn->credit_financial_account_code,
                        'effect' => 'credit',
                        'total' => $data['total'],
                        'contact_id' => $data['contact_id']
                    ];
                }
                elseif ($_creditAccount)
                {
                    $_debitAccount = $txn->debit_financial_account_code;
                    $data['ledgers'][$txn->debit_financial_account_code] = [
                        'financial_account_code' => $txn->debit_financial_account_code,
                        'effect' => 'debit',
                        'total' => $data['total'],
                        'contact_id' => $data['contact_id']
                    ];
                }
                elseif ($_debitAccount == 0 && $_creditAccount == 0)
                {
                    $_creditAccount = $txn->credit_financial_account_code;
                    $_debitAccount = $txn->debit_financial_account_code;

                    $data['ledgers'][$txn->debit_financial_account_code] = [
                        'financial_account_code' => $txn->debit_financial_account_code,
                        'effect' => 'debit',
                        'total' => $data['total'],
                        'contact_id' => $data['contact_id']
                    ];

                    $data['ledgers'][$txn->credit_financial_account_code] = [
                        'financial_account_code' => $txn->credit_financial_account_code,
                        'effect' => 'credit',
                        'total' => $data['total'],
                        'contact_id' => $data['contact_id']
                    ];
                }
                else
                {
                    $this->command->line($class.'::'.$txn->id.' - failed to generate ledger entries ');
                }
                

                foreach($data['ledgers'] as &$ledger)
                {
                    if (empty($ledger['financial_account_code']))
                    {
                        $this->command->line($class.'::'.$txn->id.' - Ledger effect ('.$ledger['effect'].') has no financial_account_code ');
                        continue;
                    }

                    $ledger['model'] = $class;
                    $ledger['model_id'] = $txn['id'];
                    $ledger['tenant_id'] = $data['tenant_id'];
                    $ledger['date'] = date('Y-m-d', strtotime($data['date']));
                    $ledger['base_currency'] = $data['base_currency'] ?? $data['currency'];
                    $ledger['quote_currency'] = $data['quote_currency'] ?? $data['currency'];
                    $ledger['exchange_rate'] = $data['exchange_rate'] ?? 1;

                    FinancialAccountLedger::create($ledger);

                    $this->updateBalances($ledger);

                }
                unset($ledger);

                $this->command->line('['.$txn->tenant_id.'] '.$class.'::'.$txn->id.' - DR: '.$_debitAccount.' / CR: '.$_creditAccount);
            }

            $this->command->line($class.' - Ledgers ['.$txns->count().'] created in FinancialAccountLedger ');

        }

        $this->command->line('- Correction complete');

        
    }

    private function updateBalances($ledger)
    {
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
            $accountBalance = AccountBalance::withoutGlobalScopes()
                ->where('tenant_id', $ledger['tenant_id'])
                ->whereDate('date', '<=', $ledger['date'])
                ->where('currency', $currency)
                ->where('financial_account_code', $ledger['financial_account_code'])
                ->orderBy('date', 'desc')
                ->first();

            //var_dump($accountBalance); exit;
            //Log::info('>>Last account balance entry for account id::'.$ledger['financial_account_code'].' in '.$currency.' date: '.$ledger['date'].': '.$ledger['effect'].' '.$ledger['total']);
            //Log::info($ledger);
            //Log::info($accountBalance);

            switch ($accountBalance)
            {
                case null:

                    //create a new balance record
                    $account_balance = new AccountBalance;
                    $account_balance->tenant_id = $ledger['tenant_id'];
                    $account_balance->date = $ledger['date'];
                    $account_balance->financial_account_code = $ledger['financial_account_code'];
                    $account_balance->currency = $currency;
                    $account_balance->debit = 0;
                    $account_balance->credit = 0;
                    $account_balance->save();

                    break;

                default:

                    //create a new row with the last balances
                    if ($ledger['date'] == $accountBalance->date)
                    {
                        //do nothing because the records for this dates balances already exists
                    }
                    else
                    {
                        $account_balance = new AccountBalance;
                        $account_balance->tenant_id = $ledger['tenant_id'];
                        $account_balance->date = $ledger['date'];
                        $account_balance->financial_account_code = $ledger['financial_account_code'];
                        $account_balance->currency = $currency;
                        $account_balance->debit = $accountBalance->debit;
                        $account_balance->credit = $accountBalance->credit;
                        $account_balance->save();
                    }

                    break;

            }

            if ($debit)
            {
                AccountBalance::withoutGlobalScopes()
                    ->where('tenant_id', $ledger['tenant_id'])
                    ->whereDate('date', '>=', $ledger['date'])
                    ->where('currency', $currency)
                    ->where('financial_account_code', $ledger['financial_account_code'])
                    ->increment('debit', $debit);
                //Log::info('debit increment: '.$debit);
                //Log::info($increment);

            }
            elseif ($credit)
            {
                AccountBalance::withoutGlobalScopes()
                    ->where('tenant_id', $ledger['tenant_id'])
                    ->whereDate('date', '>=', $ledger['date'])
                    ->where('currency', $currency)
                    ->where('financial_account_code', $ledger['financial_account_code'])
                    ->increment('credit', $credit);
                //Log::info('credit increment: '.$credit);
                //Log::info($increment);

            }
            else
            {
                $this->command->line('Neither debit of credit found');
            }

        }

    }
}
