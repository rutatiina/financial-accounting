<?php

namespace Rutatiina\FinancialAccounting\Seeders;

use Illuminate\Database\Seeder;
use Rutatiina\Bill\Models\Bill;
use Rutatiina\Sales\Models\Sales;
use Rutatiina\POS\Models\POSOrder;
use Rutatiina\Bill\Models\BillItem;
use Rutatiina\Bill\Models\RecurringBill;
use Rutatiina\Expense\Models\Expense;
use Rutatiina\Invoice\Models\Invoice;
use Rutatiina\DebitNote\Models\DebitNote;
use Rutatiina\Tenant\Scopes\TenantIdScope;
use Rutatiina\CreditNote\Models\CreditNote;
use Rutatiina\Estimate\Models\Estimate;
use Rutatiina\Expense\Models\RecurringExpense;
use Rutatiina\PaymentMade\Models\PaymentMade;
use Rutatiina\JournalEntry\Models\JournalEntry;
use Rutatiina\PaymentReceived\Models\PaymentReceived;
use Rutatiina\RetainerInvoice\Models\RetainerInvoice;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\FinancialAccounting\Models\AccountDailyBalance;
use Rutatiina\FinancialAccounting\Models\FinancialAccountLedger;
use Rutatiina\GoodsDelivered\Models\GoodsDelivered;
use Rutatiina\GoodsReceived\Models\GoodsReceived;
use Rutatiina\Invoice\Models\RecurringInvoice;
use Rutatiina\PettyCash\Models\PettyCashEntry;
use Rutatiina\PurchaseOrder\Models\PurchaseOrder;
use Rutatiina\SalesOrder\Models\SalesOrder;

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

        $doubleEntryClasses = [
            POSOrder::class,

            Sales::class,
            // Estimate::class,
            RetainerInvoice::class,
            // SalesOrder::class,
            Invoice::class,
            PaymentReceived::class,
            CreditNote::class,

            PettyCashEntry::class,
            Expense::class,
            // PurchaseOrder::class,
            Bill::class,
            PaymentMade::class,
            DebitNote::class,

            // GoodsReceived::class,
            // GoodsDelivered::class,

            JournalEntry::class,
        ];

        $this->command->line('* Time to work magic (double entries)');

        foreach($doubleEntryClasses as $class)
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
