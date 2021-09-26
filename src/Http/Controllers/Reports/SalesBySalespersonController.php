<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Reports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\Invoice\Models\Invoice;
use Rutatiina\CreditNote\Models\CreditNote;
use Rutatiina\FinancialAccounting\Models\ContactBalance;
use Rutatiina\FinancialAccounting\Models\AccountBalance;
use Rutatiina\Contact\Models\Contact;

class SalesBySalespersonController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson())
        {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }
    }

    public function generate(Request $request)
    {
        $default = [
            'total_taxable_amount' => 0,
            'total_amount' => 0,
            'count' => 0,
        ];

        $tenant = Auth::user()->tenant;

        #Get contacts
        $contacts = Contact::where('types', 'like', '%salesperson%')->get();

        foreach ($contacts as &$contact)
        {

            /*
             * -- Add the following fields to each contact --
             * $contact->invoice_count
             * $contact->sales
             * $contact->sales_with_tax
             */

            $contact->invoices = $default;
            $contact->credit_notes = $default;

            $totalSales = 0;
            $totalSalesWithTax = 0;

            #get total number of invoices per contact || todo the line bellow has whereIn('txn_type_id', [1, 13])
            $invoices = Invoice::select(
                    DB::raw('SUM(taxable_amount) as total_taxable_amount'),
                    DB::raw('SUM(total) as total_amount'),
                    DB::raw('count(id) as count')
                )
                ->where('base_currency', $tenant->base_currency)
                ->where(function ($query) use ($contact)
                {
                    $query->where('contact_id', $contact->id);
                })
                ->groupBy('tenant_id')
                ->get();

            $creditNotes = CreditNote::select(
                    DB::raw('SUM(taxable_amount) as total_taxable_amount'),
                    DB::raw('SUM(total) as total_amount'),
                    DB::raw('count(id) as count')
                )
                ->where('base_currency', $tenant->base_currency)
                ->where(function ($query) use ($contact)
                {
                    $query->where('contact_id', $contact->id);
                })
                ->groupBy('tenant_id')
                ->get();

            //return $txnSummary;

            if ($invoices->isNotEmpty())
            {
                $contact->invoices = [
                    'total_taxable_amount' => $invoices['total_taxable_amount'],
                    'total_amount' => $invoices['total_amount'],
                    'count' => $invoices['count'],
                ];

                $totalSales += $invoices['total_taxable_amount'];
                $totalSalesWithTax += $invoices['total_amount'];
            }

            if ($creditNotes->isNotEmpty())
            {
                $contact->credit_notes = [
                    'total_taxable_amount' => $creditNotes['total_taxable_amount'],
                    'total_amount' => $creditNotes['total_amount'],
                    'count' => $creditNotes['count'],
                ];

                $totalSales += $creditNotes['total_taxable_amount'];
                $totalSalesWithTax += $creditNotes['total_amount'];
            }



            $contact->total_sales = $totalSales;
            $contact->total_sales_with_tax = $totalSalesWithTax;

        }

        return [
            'contacts' => $contacts,
            'opening_date' => date('Y-m-d'),
            'closing_date' => date('Y-m-d')
        ];
    }

}
