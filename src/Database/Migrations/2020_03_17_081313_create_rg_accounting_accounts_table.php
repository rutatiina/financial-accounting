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
            $table->unsignedInteger('code'); //NOTE:: this value MUST always be numeric i.e.  a positive number
            $table->string('external_key', 250);
            $table->string('account_group_id')->default(0)->comment('Accounts group e.g. URA. 0 / Zero means group is default ie maccounts');
            $table->unsignedInteger('app_id');
            $table->unsignedInteger('parent_code')->nullable();
            $table->boolean('is_financial_account')->nullable();
            $table->string('slug', 100);
            $table->string('name', 100);
            $table->char('type', 50); //['asset', 'equity', 'expense', 'contra-expense', 'income', 'liability', 'inventory', 'cost_of_sales', 'none']
            $table->string('sub_type', 100)->nullable();
            $table->enum('balance_type', ['debit', 'credit', 'both'])->default('both');
            $table->string('description')->nullable();
            $table->unsignedTinyInteger('payment')->default(0);
            $table->unsignedBigInteger('bank_account_id')->nullable();

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
