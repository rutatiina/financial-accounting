<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Reports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\Invoice\Models\Invoice;
use Rutatiina\FinancialAccounting\Models\ContactBalance;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\Contact\Models\Contact;

class SalesByCustomerController extends Controller
{
    public function __construct()
    {}

    public function index()
	{
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }
	}

    public function generate(Request $request)
	{
        $openingData = $request->opening_date ?? date('Y-m-d');
        $closingData = $request->closing_date ?? date('Y-m-d');

        $total_invoices = 0;
        $total_sales = 0;
        $total_sales_with_tax = 0;

	    $tenant = Auth::user()->tenant;

		#Get contacts
        $contacts = Contact::where('types', 'like', '%customer%')->get();

        #Get all revenue accounts
        $revenueAccounts = Account::where('type', 'revenue')->pluck('code')->toArray();

        foreach ($contacts as &$contact) 
        {
            /*
             * -- Add the following fields to each contact --
             * $contact->invoice_count
             * $contact->sales
             * $contact->sales_with_tax
             */

            #get total number of invoices per contact
            $invoice_count = Invoice::where(function ($query) use ($contact) {
                $query->where('contact_id', $contact->id);
            })->count();

            $contact->invoice_count = $invoice_count;

            #total sales
            $salesBalances = ContactBalance::where('currency', $tenant->base_currency)
                ->select(
                    DB::raw('SUM(debit) as total_debit'),
                    DB::raw('SUM(credit) as total_credit')
                )
                ->groupBy('contact_id')
                ->where('contact_id', $contact->id)
                ->whereIn('financial_account_code', $revenueAccounts)
                ->whereDate('date', '>=', $openingData)
                ->whereDate('date', '<=', $closingData)
                ->orderBy('date', 'desc')
                ->first();

            //return $salesBalances;

            $sales = 0;
            $sales_with_tax = 0;

            if ($salesBalances) {
                $contact->sales = $sales = ($salesBalances->total_credit - $salesBalances->total_debit);
            } else {
                $contact->sales = $sales;
            }

            $contact->sales_with_tax = $sales_with_tax; //todo << fix this ASAP

            $total_invoices += $invoice_count;
            $total_sales += $sales;
            $total_sales_with_tax += $sales_with_tax;

        }

        return [
        	'contacts' => $contacts,
        	'opening_date' => $openingData,
        	'closing_date' => $closingData,
        	'total_sales' => $total_sales,
        	'total_sales_with_tax' => $total_sales_with_tax,
        	'total_invoices' => $total_invoices,
		];
	}

}
