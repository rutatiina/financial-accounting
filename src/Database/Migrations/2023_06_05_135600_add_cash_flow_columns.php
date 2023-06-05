<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCashFlowColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->table('rg_accounting_accounts', function (Blueprint $table) {
            if (!Schema::connection('tenant')->hasColumn('rg_accounting_accounts', 'cash_flow_cash_and_cash_equivalent')) $table->boolean('cash_flow_cash_and_cash_equivalent')->nullable();
            if (!Schema::connection('tenant')->hasColumn('rg_accounting_accounts', 'cash_flow_activity')) $table->string('cash_flow_activity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('tenant')->table('rg_accounting_accounts', function (Blueprint $table) {
            if (Schema::connection('tenant')->hasColumn('rg_accounting_accounts', 'cash_flow_cash_and_cash_equivalent')) $table->dropColumn('cash_flow_cash_and_cash_equivalent');
            if (Schema::connection('tenant')->hasColumn('rg_accounting_accounts', 'cash_flow_activity')) $table->dropColumn('cash_flow_activity');
        });
    }
}
