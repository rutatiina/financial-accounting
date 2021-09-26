<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Advanced;

use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Rutatiina\FinancialAccounting\Models\Entree;
use Rutatiina\FinancialAccounting\Models\TxnEntreeConfig;
use Rutatiina\FinancialAccounting\Models\TxnType;
use Rutatiina\FinancialAccounting\Classes\Transaction;
//use Rutatiina\Tenant\Traits\TenantTrait;
use Rutatiina\Contact\Traits\ContactTrait;
use Rutatiina\FinancialAccounting\Traits\FinancialAccountingTrait;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class TxnEntreeController extends Controller
{
	use FinancialAccountingTrait;

    public function __construct()
    {}

    public function index(Request $request)
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $per_page = ($request->per_page) ? $request->per_page : 20;

        return [
            'tableData' => Entree::with('configs', 'configs.debit_account', 'configs.credit_account', 'configs.txn_type')->paginate($per_page)
        ];

    }

    public function create(Request $request)
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $Tax = new Entree;
        $attributes = $Tax->rgGetAttributes();
        $attributes['configs'] = [
            [
                'txn_type_id' => '',
                'debit' => '',
                'credit' => '',
            ]
        ];
        $attributes['_method'] = 'POST';

        $data = [
            'pageTitle' => 'Create Transaction Entrees', #required
            'pageAction' => 'Create', #required
            'urlPost' => '/financial-accounts/advanced/transaction-entrees', #required
            'attributes' => $attributes, #required
            'txn_types' => TxnType::all(),
            'accounts' => self::accounts(),
        ];

        if (FacadesRequest::wantsJson()) {
            return $data;
        }
    }

    public function store(Request $request)
	{
		//print_r($request->all()); exit;

		$validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'messages' => $validator->errors()->all()];
        }

        $tenant = Auth::user()->tenant;

		$configs = $request->configs;

		foreach($configs as $key => $value) {

			$configs[$key]['debit']  = (is_numeric($value['debit'])) ? $value['debit'] : null;
			$configs[$key]['credit'] = (is_numeric($value['credit'])) ? $value['credit'] : null;

			if (empty($value['debit']) && empty($value['credit']) ) {
				return ['status' => false, 'messages' => ['Error: Transaction Entree configuration is empty.']];
			}
		}

		if (empty($configs)) {
			return ['status' => false, 'messages' => ['Error: Transaction Entree configuration not set.']];
		}

		//check if the name has been used >> Same name should not be used to avaiod confusion
		$TxnEntree = Entree::where('name', $request->name)->first();

		if ($TxnEntree) {
			return ['status' => false, 'messages' => ['Error: Transaction Entree name already used.']];
		}

		DB::beginTransaction();

        try {

			$TxnEntree = new Entree;
			$TxnEntree->slug           = Str::slug($request->name);
			$TxnEntree->name           = $request->name;
			$TxnEntree->description    = $request->description;
			$TxnEntree->valuation      = $request->valuation;
			$TxnEntree->sms_keyword    = $request->sms_keyword;
			$TxnEntree->tenant_id      = $tenant->id;
			$TxnEntree->user_id        = Auth::id();
			$TxnEntree->save();

			foreach($configs as $value) {
				$TxnEntreeConfig = new TxnEntreeConfig;
				$TxnEntreeConfig->tenant_id = $tenant->id;
				$TxnEntreeConfig->txn_entree_id = $TxnEntree->id;
				$TxnEntreeConfig->txn_type_id = $value['txn_type_id'];
				$TxnEntreeConfig->debit = $value['debit'];
				$TxnEntreeConfig->credit = $value['credit'];
				$TxnEntreeConfig->save();
			}

			DB::commit();

			return ['status' => true, 'messages' => ['Transaction Entree saved.']];

		} catch (\Exception $e) {
            DB::rollBack();
            $messages = [];
            if (App::environment('dev')) {
                $messages[] = 'Error: Failed to save transaction entree to database.';
                $messages[] = 'File: '. $e->getFile();
                $messages[] = 'Line: '. $e->getLine();
                $messages[] = 'Message: ' . $e->getMessage();

                return ['status' => false, 'messages' => $messages];
            }

            return ['status' => false, 'messages' => ['save transaction entree to database']];
        }
	}

    public function show($id)
	{}

    public function edit($id)
	{
        if (!FacadesRequest::wantsJson()) {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $Tax = Entree::with('configs')->findOrFail($id);
        $attributes = $Tax->toArray();
        $attributes['_method'] = 'PATCH';

        $data = [
            'pageTitle' => 'Create Transaction Entrees', #required
            'pageAction' => 'Create', #required
            'urlPost' => '/financial-accounts/advanced/transaction-entrees/'.$id, #required
            'attributes' => $attributes, #required
            'txn_types' => TxnType::all(),
            'accounts' => self::accounts(),
        ];

        if (FacadesRequest::wantsJson()) {
            return $data;
        }
	}

    public function update($id, Request $request)
	{
		//print_r($request->all()); exit;

		$validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => false, 'messages' => $validator->errors()->all()]);
        }

        $tenant = Auth::user()->tenant;

		$configs = $request->configs;

		foreach($configs as $key => $value) {

			$configs[$key]['debit']  = (is_numeric($value['debit'])) ? $value['debit'] : null;
			$configs[$key]['credit'] = (is_numeric($value['credit'])) ? $value['credit'] : null;

			if (empty($value['debit']) && empty($value['credit']) ) {
				return ['status' => false, 'messages' => ['Error: Transaction Entree configuration is empty.']];
			}
		}

		if (empty($configs)) {
			return ['status' => false, 'messages' => ['Error: Transaction Entree configuration not set.']];
		}

		//check if the name has been used >> Same name should not be used to avaiod confusion
		$TxnEntree = Entree::where('id', '!=', $id)->where('name', $request->name)->first();

		if ($TxnEntree) {
			return ['status' => false, 'messages' => ['Error: Transaction Entree name already used.']];
		}

		DB::beginTransaction();

        try {

			$TxnEntree = Entree::find($id);

			if($TxnEntree->tenant_id != $tenant->id) {
				return ['status' => false, 'messages' => ['Transaction Entree not found or you don\'t has rights to edit this.']];
			}

            $TxnEntree->slug           = Str::slug($request->name);
            $TxnEntree->name           = $request->name;
            $TxnEntree->description    = $request->description;
            $TxnEntree->valuation      = $request->valuation;
            $TxnEntree->sms_keyword    = $request->sms_keyword;
			$TxnEntree->save();

			//delete all the configuration
			TxnEntreeConfig::where('txn_entree_id', $id)->delete();

			foreach($configs as $value) {
				$TxnEntreeConfig = new TxnEntreeConfig;
                $TxnEntreeConfig->tenant_id = $tenant->id;
                $TxnEntreeConfig->txn_entree_id = $id;
				$TxnEntreeConfig->txn_type_id = $value['txn_type_id'];
				$TxnEntreeConfig->debit = $value['debit'];
				$TxnEntreeConfig->credit = $value['credit'];
				$TxnEntreeConfig->save();
			}

			DB::commit();

			return ['status' => true, 'messages' => ['Transaction Entree updated.']];

		} catch (\Exception $e) {
            DB::rollBack();
            $messages = [];
            if (App::environment('dev')) {
                $messages[] = 'Error: Failed to save transaction Entree to database.';
                $messages[] = 'File: '. $e->getFile();
                $messages[] = 'Line: '. $e->getLine();
                $messages[] = 'Message: ' . $e->getMessage();

                return ['status' => false, 'messages' => $messages];
            }

            return ['status' => false, 'messages' => ['Error: Failed to save transaction Entree to database.']];
        }

	}

    public function destroy($id)
	{}
}
