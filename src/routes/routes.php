<?php


Route::group(['middleware' => ['web']], function() {
    Route::get('/', '\Rutatiina\FinancialAccounting\Http\Controllers\FinancialAccountingController@index');
	Route::prefix('docs/accounting')->group(function () {
		//Route::get('api', 'Rutatiina\FinancialAccounting\Http\Controllers\ApiController@index')->name('accounting.api.index');
    });
});

Route::group(['middleware' => ['web', 'auth', 'tenant', 'service.accounting']], function() {

	Route::prefix('financial-accounts')->group(function () {

		//Route::get('rutatiina/balances', 'Rutatiina\FinancialAccounting\Http\Controllers\RutatiinaController@balances'); //delete this route when live

        // > widgets >
        Route::get('widgets/total-expenses', 'Rutatiina\FinancialAccounting\Http\Controllers\Widgets\TotalExpensesController@index');
        Route::get('widgets/total-payables', 'Rutatiina\FinancialAccounting\Http\Controllers\Widgets\TotalPayablesController@index');
        Route::get('widgets/total-income', 'Rutatiina\FinancialAccounting\Http\Controllers\Widgets\TotalIncomeController@index');
        Route::get('widgets/total-receivables', 'Rutatiina\FinancialAccounting\Http\Controllers\Widgets\TotalReceivablesController@index');
        // < widgets <

		Route::get('dashboard', 'Rutatiina\FinancialAccounting\Http\Controllers\FinancialAccountingController@index')->name('accounting.index');
		Route::get('dashboard/invoices-summary', 'Rutatiina\FinancialAccounting\Http\Controllers\DashboardController@invoicesSummary');
		Route::get('dashboard/bills-summary', 'Rutatiina\FinancialAccounting\Http\Controllers\DashboardController@billsSummary');
		Route::get('dashboard/data-count', 'Rutatiina\FinancialAccounting\Http\Controllers\DashboardController@dataCount');
		Route::get('dashboard/incomes-and-expense', 'Rutatiina\FinancialAccounting\Http\Controllers\DashboardController@revenuesAndExpense');


        // >> approve
        //Route::post('inventory/goods-received-notes/{id}/approve', 'Rutatiina\FinancialAccounting\Http\Controllers\Inventory\GoodsReceivedNoteController@approve')->name('accounting.inventory.goods-received-notes.approve');
        //Route::post('inventory/delivery-notes/{id}/approve', 'Rutatiina\FinancialAccounting\Http\Controllers\Inventory\DeliveryNoteController@approve')->name('accounting.inventory.delivery-notes.approve');
        //Route::post('inventory/goods-issued-notes/{id}/approve', 'Rutatiina\FinancialAccounting\Http\Controllers\Inventory\GoodsIssuedNoteController@approve')->name('accounting.inventory.goods-issued-notes.approve');
        //Route::post('inventory/goods-returned-notes/{id}/approve', 'Rutatiina\FinancialAccounting\Http\Controllers\Inventory\GoodsReturnedNoteController@approve')->name('accounting.inventory.goods-returned-notes.approve');
        // << approve

		//Route::any('inventory/goods-received-notes/datatables', 'Rutatiina\FinancialAccounting\Http\Controllers\Inventory\GoodsReceivedNoteController@datatables')->name('accounting.inventory.goods-received-notes.datatables');
		//Route::any('inventory/delivery-notes/datatables', 'Rutatiina\FinancialAccounting\Http\Controllers\Inventory\DeliveryNoteController@datatables')->name('accounting.inventory.delivery-notes.datatables');
		//Route::any('inventory/goods-issued-notes/datatables', 'Rutatiina\FinancialAccounting\Http\Controllers\Inventory\GoodsIssuedNoteController@datatables')->name('accounting.inventory.goods-issued-notes.datatables');
		//Route::any('inventory/goods-returned-notes/datatables', 'Rutatiina\FinancialAccounting\Http\Controllers\Inventory\GoodsReturnedNoteController@datatables')->name('accounting.inventory.goods-returned-notes.datatables');


		// Copy

		//Route::get('inventory/goods-received-notes/{id}/copy', 'Rutatiina\FinancialAccounting\Http\Controllers\Inventory\GoodsReceivedNoteController@copy')->name('accounting.inventory.goods-received-notes.copy');
		//Route::get('inventory/delivery-notes/{id}/copy', 'Rutatiina\FinancialAccounting\Http\Controllers\Inventory\DeliveryNoteController@copy')->name('accounting.inventory.delivery-notes.copy');
		//Route::get('inventory/goods-issued-notes/{id}/copy', 'Rutatiina\FinancialAccounting\Http\Controllers\Inventory\GoodsIssuedNoteController@copy')->name('accounting.inventory.goods-issued-notes.copy');
		//Route::get('inventory/goods-returned-notes/{id}/copy', 'Rutatiina\FinancialAccounting\Http\Controllers\Inventory\GoodsReturnedNoteController@copy')->name('accounting.inventory.goods-returned-notes.copy');
		// /copy

		Route::get('reports/account-statement', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\AccountStatementController@index')->name('accounting.reports.account-statement.index');
		Route::any('reports/account-statement/{id}', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\AccountStatementController@show')->name('accounting.reports.account-statement.show');

		#>> trial-balance
		Route::get('reports/trial-balance', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\TrialBalanceController@index')->name('accounting.reports.trial-balance.index');
		Route::post('reports/trial-balance', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\TrialBalanceController@generate')->name('accounting.reports.trial-balance.generate');
        #<< trial-balance

		#>> profit-and-loss
		Route::get('reports/profit-and-loss', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\ProfitAndLossController@index')->name('accounting.reports.profit-and-loss.index');
		Route::post('reports/profit-and-loss', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\ProfitAndLossController@generate')->name('accounting.reports.profit-and-loss.generate');
        #<< profit-and-loss

		#>> balance-sheet
		Route::get('reports/balance-sheet', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\BalanceSheetController@index')->name('accounting.reports.balance-sheet.index');
		Route::post('reports/balance-sheet', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\BalanceSheetController@generate')->name('accounting.reports.balance-sheet.generate');
        #<< balance-sheet

		#>> sales-by-customer
		Route::get('reports/sales-by-customer', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\SalesByCustomerController@index')->name('accounting.reports.sales-by-customer.index');
		Route::post('reports/sales-by-customer', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\SalesByCustomerController@generate')->name('accounting.reports.sales-by-customer.generate');
        #<< sales-by-customer

		#>> sales-by-item
		Route::get('reports/sales-by-item', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\SalesByItemController@index')->name('accounting.reports.sales-by-item.index');
		Route::post('reports/sales-by-item', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\SalesByItemController@generate')->name('accounting.reports.sales-by-item.generate');
        #<< sales-by-item

		#>> sales-by-salesperson
		Route::get('reports/sales-by-salesperson', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\SalesBySalespersonController@index')->name('accounting.reports.sales-by-salesperson.index');
		Route::post('reports/sales-by-salesperson', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\SalesBySalespersonController@generate')->name('accounting.reports.sales-by-salesperson.generate');
        #<< sales-by-salesperson

		#>> invoice-details
		Route::get('reports/invoice-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\InvoiceDetailsController@index')->name('accounting.reports.invoice-details.index');
		Route::post('reports/invoice-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\InvoiceDetailsController@generate')->name('accounting.reports.invoice-details.generate');
        #<< invoice-details

		#>> retainer-invoice-details
		Route::get('reports/retainer-invoice-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\RetainerInvoiceDetailsController@index')->name('accounting.reports.retainer-invoice-details.index');
		Route::post('reports/retainer-invoice-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\RetainerInvoiceDetailsController@generate')->name('accounting.reports.retainer-invoice-details.generate');
        #<< retainer-invoice-details

		#>> sales-order-details
		Route::get('reports/sales-order-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\SalesOrderDetailsController@index')->name('accounting.reports.sales-order-details.index');
		Route::post('reports/sales-order-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\SalesOrderDetailsController@generate')->name('accounting.reports.sales-order-details.generate');
        #<< sales-order-details

		#>> estimate-details
		Route::get('reports/estimate-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\EstimateDetailsController@index')->name('accounting.reports.estimate-details.index');
		Route::post('reports/estimate-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\EstimateDetailsController@generate')->name('accounting.reports.estimate-details.generate');
        #<< estimate-details

		#>> payments-received
		Route::get('reports/payments-received', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\PaymentsReceivedController@index')->name('accounting.reports.payments-received.index');
		Route::post('reports/payments-received', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\PaymentsReceivedController@generate')->name('accounting.reports.payments-received.generate');
        #<< payments-received

		#>> payments-received
		Route::get('reports/credit-note-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\CreditNoteDetailsController@index')->name('accounting.reports.credit-note-details.index');
		Route::post('reports/credit-note-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\CreditNoteDetailsController@generate')->name('accounting.reports.credit-note-details.generate');
        #<< payments-received

		#>> recurring-invoice-details
		Route::get('reports/recurring-invoice-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\RecurringInvoiceDetailsController@index')->name('accounting.reports.recurring-invoice-details.index');
		Route::post('reports/recurring-invoice-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\RecurringInvoiceDetailsController@generate')->name('accounting.reports.recurring-invoice-details.generate');
        #<< recurring-invoice-details

		#>> bills-details
		Route::get('reports/bills-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\BillsDetailsController@index')->name('accounting.reports.bills-details.index');
		Route::post('reports/bills-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\BillsDetailsController@generate')->name('accounting.reports.bills-details.generate');
        #<< bills-details

		#>> vendor-credits-details
		Route::get('reports/vendor-credits-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\VendorCreditsDetailsController@index');
		Route::post('reports/vendor-credits-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\VendorCreditsDetailsController@generate');
        #<< vendor-credits-details

		#>> purchase-order-details
		Route::get('reports/purchase-order-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\PurchaseOrderDetailsController@index');
		Route::post('reports/purchase-order-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\PurchaseOrderDetailsController@generate');
        #<< purchase-order-details

		#>> expense-details
		Route::get('reports/expense-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\ExpenseDetailsController@index');
		Route::post('reports/expense-details', 'Rutatiina\FinancialAccounting\Http\Controllers\Reports\ExpenseDetailsController@generate');
        #<< expense-details

        Route::get('accounts/{id}/transactions', 'Rutatiina\FinancialAccounting\Http\Controllers\AccountController@transactions')->name('accounting.accounts.transactions');
        Route::get('accounts/by-type/{type}', 'Rutatiina\FinancialAccounting\Http\Controllers\AccountController@byType');
        Route::get('accounts/is-payment', 'Rutatiina\FinancialAccounting\Http\Controllers\AccountController@isPayment');
        Route::get('bill-debit-financial-accounts', 'Rutatiina\FinancialAccounting\Http\Controllers\AccountController@billDebitFinancialAccounts');


		Route::resource('advanced/payment-modes', 'Rutatiina\FinancialAccounting\Http\Controllers\Advanced\PaymentModeController', ['as' => 'accounting']);


		Route::resource('journals', 'Rutatiina\FinancialAccounting\Http\Controllers\Advanced\JournalController', ['as' => 'accounting']); // << this line is to be removed after full move to vue
		Route::resource('advanced/journals', 'Rutatiina\FinancialAccounting\Http\Controllers\Advanced\JournalController', ['as' => 'accounting.advanced']);
		Route::resource('advanced/accounts', 'Rutatiina\FinancialAccounting\Http\Controllers\AccountController', ['as' => 'accounting']);

		Route::resource('reports', 'Rutatiina\FinancialAccounting\Http\Controllers\ReportController', ['as' => 'accounting']);
		#close: resources

	});

    Route::resource('financial-accounts', 'Rutatiina\FinancialAccounting\Http\Controllers\AccountController');

});

