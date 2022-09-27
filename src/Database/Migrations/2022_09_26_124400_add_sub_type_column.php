<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //https://www.freshbooks.com/en-ca/hub/accounting/types-of-accounts

        Schema::connection('tenant')->table('rg_accounting_accounts', function (Blueprint $table) {
            $table->string('sub_type', 50)->nullable()->after('type');
        });
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
