<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Advanced;

use URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Rutatiina\Contact\Traits\ContactTrait;
use Rutatiina\Item\Traits\ItemsVueSearchSelect;
use Rutatiina\FinancialAccounting\Traits\FinancialAccountingTrait;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class JournalController extends Controller
{
    use ItemsVueSearchSelect; //calls AccountingTrait

    private  $txnEntreeSlug = 'journal';

    public function __construct()
    {}

    public function index(Request $request)
	{
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }

        $per_page = ($request->per_page) ? $request->per_page : 20;

        $sort_by = [];

        if ($request->search_column) {
            $sort_by = [
                $request->search_column => $request->search_value
            ];
        }

        //return $sort_by;

        $txns =[];

        //put the correct data fetching
        //$txns = Transaction::setRoute('show', route('accounting.sales.estimates.show', '_id_'))
        //    ->setRoute('edit', route('accounting.sales.estimates.edit', '_id_'))
        //    ->setRoute('process', route('accounting.sales.estimates.process', '_id_'))
        //    ->setSortBy($sort_by)
        //    ->paginatePerPage($per_page)
        //    ->returnModel(true) //not necessary because paginate returns model
        //    ->paginate(true)
        //    ->findByEntree($this->txnEntreeSlug);

        return [
            'tableData' => $txns
        ];

        //return view('accounting::journals.index');
	}

    public function create()
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }

        $tenant = Auth::user()->tenant;

        $TxnNumber = new TxnNumber();

        $itemDefaults = $this->itemCreate();

        $Txn = new Txn;
        $txnAttributes = $Txn->rgGetAttributes();

        $txnAttributes['status'] = 'Approved';
        $txnAttributes['contact_id'] = '';
        $txnAttributes['contact'] = json_decode('{"currencies":[]}'); #required
        $txnAttributes['date'] = date('Y-m-d');
        $txnAttributes['number'] = $TxnNumber->run($this->txnEntreeSlug);
        $txnAttributes['base_currency'] = $tenant->base_currency;
        $txnAttributes['quote_currency'] = $tenant->base_currency;
        $txnAttributes['taxes'] = json_decode('{}');
        $txnAttributes['isRecurring'] = false;
        $txnAttributes['recurring'] = [
            'date_range' => [],
            'day_of_month' => '*',
            'month' => '*',
            'day_of_week' => '*',
        ];
        $txnAttributes['contact_notes'] = null;
        $txnAttributes['terms_and_conditions'] = null;
        $txnAttributes['items'] = [$itemDefaults,$itemDefaults];

        $txnAttributes['totalDebit'] = 0;
        $txnAttributes['totalCredit'] = 0;

        $data = [
            'pageTitle' => 'Create Journal', #required
            'pageAction' => 'Create', #required
            'txnUrlStore' => '/financial-accounts/advanced/journals', #required
            'txnAttributes' => $txnAttributes, #required
        ];

        if (FacadesRequest::wantsJson()) {
            return $data;
        }

        $txn = new Txn;
        return view('accounting::journals.create')->with([
            'txn'       => $txn,
            'contacts'  => static::contactsByTypes(['customer']),
        ]);
	}

    public function store(Request $request)
	{
    	//return $request->all();

        $data = $request->all();

        $rules = [
            'items.*.debit' => ['numeric', 'gt:0', 'nullable'],
            'items.*.credit' => ['numeric', 'gt:0', 'nullable']
        ];

        $request->validate($rules);

        foreach ($data['items'] as &$item) {
            $item['type'] = 'account';

            if (isset($item['debit']) && isset($item['credit'])) {
                if ($item['debit'] > 0 && $item['credit'] > 0) {
                    return response()->json([
                        'message' => 'Journal Error!',
                        'errors' => ['Both debit and credit cannot be set on the same item.']
                    ], 422);
                }
            }
        }
        unset($item);

        foreach ($data['items'] as &$item) {
            $item['type'] = 'account';
        }

        $request->validate($rules);

        //return $data;

        $TxnStore = new TxnStore();
        $TxnStore->txnEntreeSlug = $this->txnEntreeSlug;
        $TxnStore->txnInsertData = $data;
        $insert = $TxnStore->run();

        if ($insert == false) {
            return [
                'status'    => false,
                'messages'  => $TxnStore->errors
            ];
        }

        return [
            'status'    => true,
            'messages'  => ['Journal saved'],
            'number'    => 0,
            'callback'  => URL::route('accounting.advanced.journals.show', [$insert->id], false)
        ];
	}

    public function show($id)
	{
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }

        if (FacadesRequest::wantsJson()) {
            $TxnRead = new TxnRead();
            return $TxnRead->run($id);
        }
    }

    public function edit($txnId) {}

    public function update(Request $request) {}

    public function destroy() {}

    public function datatables() {

        $txns = Transaction::paginate(false)->findByEntree('journal');

        return Datatables::of($txns)->make(true);
    }

    public function exportToExcel() {
        $export = Txn::all()->downloadExcel(
            'journal.xlsx',
            null,
            false
        );

        //$books->load('author', 'publisher'); //of no use

        return $export;
    }
}
