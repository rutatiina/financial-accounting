<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCanceledColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = [

            //banking
            'rg_banking_transactions',

            //pos
            'rg_pos_orders',

            //sales
            'rg_sales',
            'rg_estimates',
            'rg_retainer_invoices',
            'rg_sales_orders',
            'rg_invoices',
            'rg_payments_received',
            'rg_recurring_invoices',
            'rg_credit_notes',

            //purchases & expenses
            'rg_petty_cash_entries',
            'rg_expenses',
            'rg_expense_recurring_expenses',
            'rg_purchase_orders',
            'rg_bills',
            'rg_payments_made',
            'rg_bill_recurring_bills',
            'rg_debit_notes',

            //inventory
            'rg_goods_received',
            'rg_goods_delivered',
            'rg_goods_issued',
            'rg_goods_returned',
			
		];

        foreach ($tables as $t) 
        {
            if (Schema::connection('tenant')->hasColumn($t, 'canceled'))
            {
                continue;
            }
            elseif (Schema::connection('tenant')->hasColumn($t, 'status'))
            {
                Schema::connection('tenant')->table($t, function (Blueprint $table) {
                    $table->unsignedTinyInteger('canceled')->nullable()->default(0)->after('status');
                });
            }
            else
            {
                Schema::connection('tenant')->table($t, function (Blueprint $table) {
                    $table->unsignedTinyInteger('canceled')->nullable()->default(0);
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //do nothing
    }
}
