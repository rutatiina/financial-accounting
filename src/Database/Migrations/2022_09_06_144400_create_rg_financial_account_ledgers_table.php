<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRgFinancialAccountLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->dropIfExists('rg_financial_account_ledgers');
        Schema::connection('tenant')->dropIfExists('rg_financial_accounts_ledgers');

        Schema::connection('tenant')->create('rg_financial_account_ledgers', function (Blueprint $table)
        {
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
            $table->string('model', 2500);
            $table->unsignedBigInteger('model_id');
            $table->date('date');
            $table->date('external_date')->nullable();
            $table->unsignedBigInteger('financial_account_code');
            $table->enum('effect', ['debit', 'credit']);
            $table->unsignedDecimal('total', 20, 5);
            $table->string('base_currency', 3);
            $table->string('quote_currency', 3);
            $table->unsignedDecimal('exchange_rate', 20,5);
            $table->unsignedBigInteger('contact_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('tenant')->dropIfExists('rg_financial_account_ledgers');
    }
}
