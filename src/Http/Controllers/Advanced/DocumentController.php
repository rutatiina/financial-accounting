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
use Rutatiina\FinancialAccounting\Models\TxnType;
use Yajra\DataTables\Facades\DataTables;

class DocumentController extends Controller
{
    public function __construct()
    {}

    public function index(Request $request)
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }

        $per_page = ($request->per_page) ? $request->per_page : 20;

        return [
            'tableData' => TxnType::paginate($per_page)
        ];

    }

    public function create(Request $request)
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }

        $Tax = new TxnType;
        $attributes = $Tax->rgGetAttributes();
        $attributes['_method'] = 'POST';

        $data = [
            'pageTitle' => 'Create Transaction Type', #required
            'pageAction' => 'Create', #required
            'urlPost' => '/financial-accounts/advanced/transaction-types', #required
            'attributes' => $attributes, #required
        ];

        if (FacadesRequest::wantsJson()) {
            return $data;
        }
    }

    public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'messages' => $validator->errors()->all()];
        }


		//check if the name has been used
		$TxnType = TxnType::where('name', $request->name)->first();
		if ($TxnType) {
			return ['status' => false, 'messages' => ['Error: Transaction Type name already used.']];
		}

		$TxnType = new TxnType;
		$TxnType->tenant_id = Auth::user()->tenant->id;
		$TxnType->user_id = Auth::id();
		$TxnType->slug = Str::slug($request->name);
		$TxnType->name = $request->name;
		$TxnType->category = $request->category;
		$TxnType->privacy = $request->privacy;
		$TxnType->show_payment_instructions = $request->show_payment_instructions;
		$TxnType->show_terms_and_conditions = $request->show_terms_and_conditions;
		$TxnType->save();

		return ['status' => true, 'messages' => ['Transaction type saved.']];
	}

    public function show($id)
	{}

    public function edit($id)
	{
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }

        $Tax = TxnType::find($id);
        $attributes = $Tax->toArray();
        $attributes['_method'] = 'PATCH';

        $data = [
            'pageTitle' => 'Edit Transaction Type', #required
            'pageAction' => 'Edit', #required
            'urlPost' => '/financial-accounts/advanced/transaction-types/'.$id, #required
            'attributes' => $attributes, #required
        ];

        if (FacadesRequest::wantsJson()) {
            return $data;
        }


		$TxnType = TxnType::findOrFail($id);
		return view('accounting::settings.txn_type.edit')->with([
			'type' => $TxnType,
		]);
	}

    public function update($id, Request $request)
	{
		$validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => false, 'messages' => $validator->errors()->all()]);
        }

        $tenant = Auth::user()->tenant;

        $TxnType = TxnType::find($id);

        if($TxnType->tenant_id != $tenant->id) {
            return ['status' => false, 'messages' => ['Transaction Type not found or you don\'t has rights to edit this.']];
        }

		$TxnType = TxnType::where('name', $request->name)->where('id', '!=', $id)->first();
		if ($TxnType) {
			return json_encode(['status' => false, 'messages' => ['Error: Transaction Type name already used.']]);
		}

		$TxnType = TxnType::find($id);
		$TxnType->slug = Str::slug($request->name);
		$TxnType->name = $request->name;
		$TxnType->show_payment_instructions = $request->show_payment_instructions;
		$TxnType->show_terms_and_conditions = $request->show_terms_and_conditions;
		$TxnType->save();

		return json_encode(['status' => true, 'messages' => ['Transaction type updated.']]);
	}

    public function destroy($id)
	{}

    public function datatables()
	{
        return Datatables::of(TxnType::query())->make(true);
    }
}
