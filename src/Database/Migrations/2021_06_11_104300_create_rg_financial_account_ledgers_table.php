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
        Schema::connection('tenant')->create('rg_financial_account_ledgers', function (Blueprint $table)
        {
            /*
             * The temporary method may be used to indicate that the table should be "temporary".
             * Temporary tables are only visible to the current connection's database session and are dropped automatically when the connection is closed:
             */
            $table->temporary();

            $table->bigIncrements('id');
            $table->timestamps();

            //>> default columns
            $table->softDeletes();
            $table->unsignedBigInteger('tenant_id');
            //<< default columns

            //>> table columns
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('transaction_name', 50); //e.g. invoice
            $table->unsignedBigInteger('transaction_id'); //e.g. 23
            $table->date('date');
            $table->unsignedBigInteger('financial_account_code');
            $table->enum('effect', ['debit', 'credit']);
            $table->unsignedDecimal('total', 20, 5);
            $table->string('base_currency', 3);
            $table->string('quote_currency', 3);
            $table->unsignedDecimal('exchange_rate', 20,5);
            $table->unsignedBigInteger('contact_id');

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
