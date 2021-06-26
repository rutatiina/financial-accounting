<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRgFinancialAccountingAccountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('rg_financial_accounting_account_types', function (Blueprint $table) {
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
            $table->string('type')->comment('asset, liability, equity, expense, revenue');
            $table->enum('balance', ['dr', 'cr', 'dr-or-cr'])->nullable();
            $table->unsignedInteger('name');
            $table->unsignedInteger('tenant_code')->nullable();
            $table->string('description')->nullable();

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
        Schema::connection('tenant')->dropIfExists('rg_financial_accounting_account_types');
    }
}
