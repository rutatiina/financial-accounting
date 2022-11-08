<?php

namespace Rutatiina\FinancialAccounting\Seeders;

use Illuminate\Database\Seeder;
use Rutatiina\Bill\Models\Bill;
use Rutatiina\Sales\Models\Sales;
use Rutatiina\POS\Models\POSOrder;
use Rutatiina\Bill\Models\BillItem;
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
use Rutatiina\FinancialAccounting\Models\AccountDailyBalance;
use Rutatiina\FinancialAccounting\Models\FinancialAccountLedger;

//php artisan db:seed --class=\\Rutatiina\\FinancialAccounting\\Seeders\\AccountDailyBalancesSeeder

class AccountDailyBalancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountDailyBalance::truncate();
        
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
            // 'credit_note_id' => CreditNote::class,
            // 'debit_note_id' => DebitNote::class,
            // 'expense_id' => Expense::class,
            // 'invoice_id' => Invoice::class,
                // 'journal_entry_id' => JournalEntry::class,
            // 'payment_received_id' => PaymentReceived::class,
            // 'payment_made_id' => PaymentMade::class,
            // 'pos_order_id' => POSOrder::class,
            // 'retainer_invoice_id' => RetainerInvoice::class,
            // 'sales_id' => Sales::class
        ];

        $this->command->line('* Time to work magic');

        foreach($classes as $key_name => $class)
        {
            $txns = (new $class)->withoutGlobalScopes()
                ->with(['ledgers' => function ($query) {
                    $query->withoutGlobalScopes();
                }])
                ->get();

            foreach ($txns as $txn) 
            {
               
                foreach ($txn->ledgers as $ledger)
                {
                    AccountDailyBalance::withoutGlobalScopes()
                        ->firstOrCreate([
                            'tenant_id' => $ledger['tenant_id'],
                            'date' => $ledger['date'],
                            'currency' => $ledger['base_currency'],
                            'financial_account_code' => $ledger['financial_account_code']
                        ]);

                    if ($ledger['effect'] == 'debit')
                    {
                        AccountDailyBalance::withoutGlobalScopes()
                            ->whereDate('date', $ledger['date'])
                            ->where('currency', $ledger['base_currency'])
                            ->where('financial_account_code', $ledger['financial_account_code'])
                            ->increment('debit', $ledger['total']);

                    }

                    if ($ledger['effect'] == 'credit')
                    {
                        AccountDailyBalance::withoutGlobalScopes()
                            ->whereDate('date', $ledger['date'])
                            ->where('currency', $ledger['base_currency'])
                            ->where('financial_account_code', $ledger['financial_account_code'])
                            ->increment('credit', $ledger['total']);

                    }

                }

                $this->command->line('['.$txn->tenant_id.'] '.$class.'::'.$txn->id.' - Daily balances updated ');
            }

        }

        $this->command->line('- Update of daily balances complete');

        
    }
}
