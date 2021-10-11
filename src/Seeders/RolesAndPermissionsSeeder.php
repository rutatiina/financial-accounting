<?php

namespace Rutatiina\FinancialAccounting\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table(config('permission.table_names.model_has_permissions'))->truncate();
        DB::table(config('permission.table_names.model_has_roles'))->truncate();
        DB::table(config('permission.table_names.role_has_permissions'))->truncate();
        Permission::truncate();
        Role::truncate();
        DB::statement("SET foreign_key_checks=1");

        $permissions = [
            'users.*',
            'users.view',
            'users.create',
            'users.update',
            'users.delete',

            'permissions.*',
            'permissions.view',
            'permissions.create',
            'permissions.update',
            'permissions.delete',

            'roles.*',
            'roles.view',
            'roles.create',
            'roles.update',
            'roles.delete',

            'contacts.*',
            'contacts.view',
            'contacts.create',
            'contacts.update',
            'contacts.delete',

            'items.*',
            'items.view',
            'items.create',
            'items.update',
            'items.delete',

            'banking.*',
            'banking.bank.*',
            'banking.bank.view',
            'banking.bank.create',
            'banking.bank.update',
            'banking.bank.delete',

            'banking.accounts.*',
            'banking.accounts.view',
            'banking.accounts.create',
            'banking.accounts.update',
            'banking.accounts.delete',

            'dashboard.*',
            'dashboard.view',
            'dashboard.customize',

            'estimates.*',
            'estimates.view',
            'estimates.create',
            'estimates.update',
            'estimates.delete',

            'retainer-invoices.*',
            'retainer-invoices.view',
            'retainer-invoices.create',
            'retainer-invoices.update',
            'retainer-invoices.delete',

            'sales-orders.*',
            'sales-orders.view',
            'sales-orders.create',
            'sales-orders.update',
            'sales-orders.delete',

            'invoices.*',
            'invoices.view',
            'invoices.create',
            'invoices.update',
            'invoices.delete',

            'receipts.*',
            'receipts.view',
            'receipts.create',
            'receipts.update',
            'receipts.delete',

            'recurring-invoices.*',
            'recurring-invoices.view',
            'recurring-invoices.create',
            'recurring-invoices.update',
            'recurring-invoices.delete',

            'credit-notes.*',
            'credit-notes.view',
            'credit-notes.create',
            'credit-notes.update',
            'credit-notes.delete',

            'expenses.*',
            'expenses.view',
            'expenses.create',
            'expenses.update',
            'expenses.delete',

            'recurring-expenses.*',
            'recurring-expenses.view',
            'recurring-expenses.create',
            'recurring-expenses.update',
            'recurring-expenses.delete',

            'purchase-orders.*',
            'purchase-orders.view',
            'purchase-orders.create',
            'purchase-orders.update',
            'purchase-orders.delete',

            'bills.*',
            'bills.view',
            'bills.create',
            'bills.update',
            'bills.delete',

            'payments.*',
            'payments.view',
            'payments.create',
            'payments.update',
            'payments.delete',

            'recurring-bills.*',
            'recurring-bills.view',
            'recurring-bills.create',
            'recurring-bills.update',
            'recurring-bills.delete',

            'debit-notes.*',
            'debit-notes.view',
            'debit-notes.create',
            'debit-notes.update',
            'debit-notes.delete',

            'goods-received-notes.*',
            'goods-received-notes.view',
            'goods-received-notes.create',
            'goods-received-notes.update',
            'goods-received-notes.delete',

            'delivery-notes.*',
            'delivery-notes.view',
            'delivery-notes.create',
            'delivery-notes.update',
            'delivery-notes.delete',

            'goods-issued-notes.*',
            'goods-issued-notes.view',
            'goods-issued-notes.create',
            'goods-issued-notes.update',
            'goods-issued-notes.delete',

            'goods-returned-notes.*',
            'goods-returned-notes.view',
            'goods-returned-notes.create',
            'goods-returned-notes.update',
            'goods-returned-notes.delete',

            'journals.*',
            'journals.view',
            'journals.create',
            'journals.update',
            'journals.delete',

            'chat-of-accounts.*',
            'chat-of-accounts.view',
            'chat-of-accounts.create',
            'chat-of-accounts.update',
            'chat-of-accounts.delete',

            'reports.view',
        ];

        // create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::firstOrCreate(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::firstOrCreate(['name' => 'tenant-admin']);
        $tenant_admin_permissions = [
            'users.*',

            'contacts.view',
            'contacts.create',
            'contacts.update',
            'contacts.delete',

            'items.view',
            'items.create',
            'items.update',
            'items.delete',

            'banking.bank.view',
            'banking.bank.create',
            'banking.bank.update',
            'banking.bank.delete',

            'banking.accounts.view',
            'banking.accounts.create',
            'banking.accounts.update',
            'banking.accounts.delete',

            'dashboard.view',
            'dashboard.customize',

            'estimates.view',
            'estimates.create',
            'estimates.update',
            'estimates.delete',

            'retainer-invoices.view',
            'retainer-invoices.create',
            'retainer-invoices.update',
            'retainer-invoices.delete',

            'sales-orders.view',
            'sales-orders.create',
            'sales-orders.update',
            'sales-orders.delete',

            'invoices.view',
            'invoices.create',
            'invoices.update',
            'invoices.delete',

            'receipts.view',
            'receipts.create',
            'receipts.update',
            'receipts.delete',

            'recurring-invoices.view',
            'recurring-invoices.create',
            'recurring-invoices.update',
            'recurring-invoices.delete',

            'credit-notes.view',
            'credit-notes.create',
            'credit-notes.update',
            'credit-notes.delete',

            'expenses.view',
            'expenses.create',
            'expenses.update',
            'expenses.delete',

            'recurring-expenses.view',
            'recurring-expenses.create',
            'recurring-expenses.update',
            'recurring-expenses.delete',

            'purchase-orders.view',
            'purchase-orders.create',
            'purchase-orders.update',
            'purchase-orders.delete',

            'bills.view',
            'bills.create',
            'bills.update',
            'bills.delete',

            'payments.view',
            'payments.create',
            'payments.update',
            'payments.delete',

            'recurring-bills.view',
            'recurring-bills.create',
            'recurring-bills.update',
            'recurring-bills.delete',

            'debit-notes.view',
            'debit-notes.create',
            'debit-notes.update',
            'debit-notes.delete',

            'goods-received-notes.view',
            'goods-received-notes.create',
            'goods-received-notes.update',
            'goods-received-notes.delete',

            'delivery-notes.view',
            'delivery-notes.create',
            'delivery-notes.update',
            'delivery-notes.delete',

            'goods-issued-notes.view',
            'goods-issued-notes.create',
            'goods-issued-notes.update',
            'goods-issued-notes.delete',

            'goods-returned-notes.view',
            'goods-returned-notes.create',
            'goods-returned-notes.update',
            'goods-returned-notes.delete',

            'journals.view',
            'journals.create',
            'journals.update',
            'journals.delete',

            'chat-of-accounts.view',
            'chat-of-accounts.create',
            'chat-of-accounts.update',
            'chat-of-accounts.delete',

            'reports.view',
        ];
        foreach ($tenant_admin_permissions as $permission) {
            $role->givePermissionTo($permission);
        }

    }
}
