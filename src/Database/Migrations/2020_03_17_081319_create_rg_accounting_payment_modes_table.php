<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRgAccountingPaymentModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('rg_accounting_payment_modes', function (Blueprint $table) {
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
            $table->string('country', 3);
            $table->string('name', 50);
            $table->string('display_name', 50);
            $table->string('value', 20);
            $table->enum('based_on', ['item', 'total']);
            $table->unsignedTinyInteger('inclusive');
            $table->unsignedTinyInteger('on_sale');
            $table->enum('on_sale_effect', ['debit', 'credit']);
            $table->unsignedBigInteger('on_sale_financial_account_code');
            $table->unsignedTinyInteger('on_bill');
            $table->enum('on_bill_effect', ['debit', 'credit']);
            $table->unsignedBigInteger('on_bill_financial_account_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('tenant')->dropIfExists('rg_accounting_payment_modes');
    }
}
