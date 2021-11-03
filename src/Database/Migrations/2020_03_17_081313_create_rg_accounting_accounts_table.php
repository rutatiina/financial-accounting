<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRgAccountingAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('rg_accounting_accounts', function (Blueprint $table) {
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
            $table->unsignedInteger('code')->nullable(); //NOTE:: this value MUST always be numeric i.e.  a positive number
            //$table->string('account_group_id')->default(0)->comment('Accounts group e.g. URA. 0 / Zero means group is default ie maccounts');
            //$table->unsignedInteger('parent_code')->nullable();
            $table->string('name', 100);
            $table->char('type', 50); //['asset', 'equity', 'expense', 'income', 'liability']
            $table->unsignedInteger('financial_account_category_code');
            $table->enum('balance', ['debit', 'credit', 'both'])->default('both');
            $table->string('description')->nullable();
            $table->unsignedTinyInteger('payment')->default(0)->nullable(); //todo this field is to be removed
            $table->unsignedBigInteger('bank_account_id')->nullable(); //todo this field is to be removed

            //indexes
            $table->index(['tenant_id', 'code'], 'tenant_index');
            $table->unique(['tenant_id', 'code'], 'tenant_unique');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('tenant')->dropIfExists('rg_accounting_accounts');
    }
}
