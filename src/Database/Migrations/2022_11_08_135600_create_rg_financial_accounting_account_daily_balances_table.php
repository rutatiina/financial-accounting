<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRgFinancialAccountingAccountDailyBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('rg_financial_accounting_account_daily_balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            //>> default columns
            $table->softDeletes();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            //<< default columns

            //>> table columns
            $table->unsignedBigInteger('project_id')->nullable();
            $table->date('date');
            $table->bigInteger('financial_account_code');
            $table->string('currency', 3);
            $table->unsignedDecimal('debit', 30, 5)->nullable()->default(0);
            $table->unsignedDecimal('credit', 30, 5)->nullable()->default(0);

            $table->unique(
                [
                    'tenant_id',
                    'date',
                    'financial_account_code',
                    'currency'
                ],
                'unique'
            );

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('tenant')->dropIfExists('rg_financial_accounting_account_daily_balances');
    }
}
