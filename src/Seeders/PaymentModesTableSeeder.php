<?php

namespace Rutatiina\FinancialAccounting\Seeders;

use Illuminate\Database\Seeder;
use Rutatiina\FinancialAccounting\Models\PaymentMode;

class PaymentModesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMode::insert(
            array (
                0 =>
                    array (
                        'id' => 1,
                        'created_at' => NULL,
                        'updated_at' => NULL,
                        'tenant_id' => 0,
                        'name' => 'Cash',
                    ),
                1 =>
                    array (
                        'id' => 2,
                        'created_at' => NULL,
                        'updated_at' => NULL,
                        'tenant_id' => 0,
                        'name' => 'Bank Remittance',
                    ),
                2 =>
                    array (
                        'id' => 3,
                        'created_at' => NULL,
                        'updated_at' => NULL,
                        'tenant_id' => 0,
                        'name' => 'Bank Transfer',
                    ),
                3 =>
                    array (
                        'id' => 4,
                        'created_at' => NULL,
                        'updated_at' => NULL,
                        'tenant_id' => 0,
                        'name' => 'Check / Cheque',
                    ),
                4 =>
                    array (
                        'id' => 5,
                        'created_at' => NULL,
                        'updated_at' => NULL,
                        'tenant_id' => 0,
                        'name' => 'Credit Card',
                    ),
                5 =>
                    array (
                        'id' => 6,
                        'created_at' => NULL,
                        'updated_at' => NULL,
                        'tenant_id' => 0,
                        'name' => 'Mobile money',
                    ),
            )
        );
    }
}
