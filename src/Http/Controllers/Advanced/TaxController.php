<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers\Advanced;

use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rutatiina\Tax\Models\Tax;
use Rutatiina\Globals\Services\Currencies  as ClassesCurrencies;
use Rutatiina\Globals\Services\Countries  as ClassesCountries;
use Rutatiina\Item\Traits\ItemsVueSearchSelect;

class TaxController extends Controller
{
    use ItemsVueSearchSelect; //calls AccountingTrait

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
            'tableData' => Tax::with(['on_sale_account', 'on_bill_account'])->paginate($per_page)
        ];

	}

    public function create(Request $request)
	{
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $Tax = new Tax;
        $attributes = $Tax->rgGetAttributes();
        $attributes['_method'] = 'POST';

        $data = [
            'pageTitle' => 'Create Tax', #required
            'pageAction' => 'Create', #required
            'urlPost' => '/taxes', #required
            'attributes' => $attributes, #required
            'currencies' => ClassesCurrencies::en_IN(),
            'countries' => ClassesCountries::ungrouped(),
            'taxes' => Tax::all(),
            'accounts' => self::accounts(),
        ];

        if (FacadesRequest::wantsJson()) {
            return $data;
        }
    }

    public function store(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'display_name' => ['required', 'string', 'max:30'],
            'value' => ['required', 'string'],
            'based_on' => ['in:item,total'],
            'on_sale_effect' => ['required_with:on_sale', 'in:debit,credit', 'nullable'],
            'on_sale_financial_account_code' => ['required_with:on_sale', 'integer', 'nullable'],
            'on_bill_effect' => ['required_with:on_bill', 'in:debit,credit', 'nullable'],
            'on_bill_financial_account_code' => ['required_with:on_bill', 'integer', 'nullable'],
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => false, 'messages' => $validator->errors()->all()]);
        }

        $tax                    = new Tax;
        $tax->tenant_id         = Auth::user()->tenant->id;
        $tax->user_id           = Auth::id();
        $tax->name              = $request->name;
        $tax->display_name      = $request->display_name;
        $tax->country           = $request->country;
        $tax->value             = $request->value;
        $tax->based_on          = $request->based_on;
        $tax->inclusive         = $request->inclusive;
        $tax->on_sale           = $request->on_sale;
        $tax->on_sale_effect    = $request->on_sale_effect;
        $tax->on_sale_financial_account_code   = $request->on_sale_financial_account_code;
        $tax->on_bill           = $request->on_bill;
        $tax->on_bill_effect    = $request->on_bill_effect;
        $tax->on_bill_financial_account_code   = $request->on_bill_financial_account_code;
        $tax->save();

        return [
            'status' => true,
            'messages' => ['Tax successfully saved.']
        ];
	}

    public function show($id)
	{}

    public function edit($id)
	{
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $Tax = Tax::find($id);
        $attributes = $Tax->toArray();
        $attributes['_method'] = 'PATCH';

        $data = [
            'pageTitle' => 'Update Tax', #required
            'pageAction' => 'Update', #required
            'urlPost' => '/taxes/'.$id, #required
            'attributes' => $attributes, #required
            'accounts' => self::accounts(),
        ];

        return $data;

    }

    public function update(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'display_name' => ['required', 'string', 'max:30'],
            'value' => ['required', 'string'],
            'based_on' => ['in:item,total'],
            'on_sale_effect' => ['required_with:on_sale', 'in:debit,credit', 'nullable'],
            'on_sale_financial_account_code' => ['required_with:on_sale', 'integer', 'nullable'],
            'on_bill_effect' => ['required_with:on_bill', 'in:debit,credit', 'nullable'],
            'on_bill_financial_account_code' => ['required_with:on_bill', 'integer', 'nullable'],
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => false, 'messages' => $validator->errors()->all()]);
        }

        $tenant = Auth::user()->tenant;

        $tax = Tax::find($request->id);

        if($tax->tenant_id != $tenant->id) {
            return ['status' => false, 'messages' => ['Tax not found or you don\'t has rights to edit this.']];
        }

        $tax->tenant_id         = $tenant->id;
        $tax->user_id           = Auth::id();
        $tax->name              = $request->name;
        $tax->display_name      = $request->display_name;
        $tax->country           = $request->country;
        $tax->value             = $request->value;
        $tax->based_on          = $request->based_on;
        $tax->inclusive         = $request->inclusive;
        $tax->on_sale           = $request->on_sale;
        $tax->on_sale_effect    = $request->on_sale_effect;
        $tax->on_sale_financial_account_code = $request->on_sale_financial_account_code;
        $tax->on_bill           = $request->on_bill;
        $tax->on_bill_effect    = $request->on_bill_effect;
        $tax->on_bill_financial_account_code = $request->on_bill_financial_account_code;
        $tax->save();

        return [
            'status' => true,
            'messages' => ['Tax successfully Updates.']
        ];
    }

    public function destroy($id)
	{
		$tax = Tax::find($id);

        if($tax->delete()) {
            return redirect()->back()->with('success', 'Tax successfully deleted');
        }
	}

    public function selectOptions(Request $request)
    {
        $per_page = ($request->per_page) ? $request->per_page : 20;

        return Tax::paginate($per_page);

    }
}
