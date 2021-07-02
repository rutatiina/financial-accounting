<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers;

use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;
use Rutatiina\FinancialAccounting\Models\FinancialAccountType;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\FinancialAccounting\Models\Txn;
use Rutatiina\Classes\Currencies as ClassesCurrencies;
use Rutatiina\Classes\Countries as ClassesCountries;
use Yajra\DataTables\Facades\DataTables;

class AccountController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson())
        {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }

        $query = Account::setCurrency(Auth::user()->tenant->base_currency)->query();
        $query->orderBy('name', 'asc');

        if ($request->search_value)
        {
            //$request->except(['page']);
            //$request->only(['search_value']);
            $request->request->remove('page');
            //return $request->all();

            $query->where('name', 'like', '%'.$request->search_value.'%');
        }

        $AccountPaginate = $query->paginate(20);

        return [
            'tableData' => $AccountPaginate
        ];
    }

    public function create()
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson())
        {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }

        return [
            'attributes' => (new Account)->rgGetAttributes(),
            'financialAccountTypes' => FinancialAccountType::all()->groupBy('title')
        ];
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'code' => 'string|nullable',
            'type' => 'required|in:asset,equity,expense,income,liability,inventory,cost_of_sales,none',
            'sub_type' => 'string|nullable',
            'description' => 'string|nullable',
            'payment' => 'string|nullable',
        ]);

        if ($validator->fails())
        {
            return [
                'status' => false,
                'messages' => $validator->errors()->all(),
            ];
        }

        $Account = new Account;
        $Account->tenant_id = Auth::user()->tenant->id;
        $Account->user_id = Auth::id();
        $Account->slug = Str::slug($request->name);
        $Account->name = $request->name;
        $Account->code = $request->code;
        $Account->type = $request->type;
        $Account->sub_type = $request->sub_type;
        $Account->description = $request->description;
        $Account->payment = $request->payment;
        $Account->save();

        return [
            'status' => true,
            'messages' => ['Account successfully saved'],
        ];
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request)
    {
    }

    public function destroy($id)
    {
        $account = Account::find($id)->whereNull('user_id');

        if ($account->delete())
        {
            return redirect()->back()->with('success', 'Account successfully deleted');
        }
    }

    public function transactions($id)
    {
        $query = Txn::query();
        $query->where('debit', $id);
        $query->orWhere('credit', $id);

        $data = Datatables::of($query)->toArray();

        //print_r($data['data']); exit;

        foreach ($data['data'] as $index => $value)
        {
            $data['data'][$index]['description'] = 'Doc type #' . $value['number'];
            $data['data'][$index]['currency'] = $value['base_currency'];
            $data['data'][$index]['debit_amount'] = ($value['debit'] == $id) ? floatval($value['total']) : 0;
            $data['data'][$index]['credit_amount'] = ($value['credit'] == $id) ? floatval($value['total']) : 0;
        }

        return json_encode($data);
    }

    public function byType($type)
    {
        return Account::where('type', $type)->paginate(50);
    }

    public function isPayment()
    {
        //only account labeled payment are displayed here
        //e.g. a bank account may not be used for payments thus showing all bank accounts is incorrect
        return Account::where('payment', 1)->paginate(50);
    }

    public function billDebitFinancialAccounts(Request $request)
    {
        //$query = Account::setCurrency(Auth::user()->tenant->base_currency)->query();
        return Account::select(['code', 'name', 'type'])
            ->whereIn('type', ['liability','expense', 'equity'])
            ->where(function($query) use ($request)
            {
                if ($request->search_value)
                {
                    //$request->except(['page']);
                    //$request->only(['search_value']);
                    $request->request->remove('page');
                    //return $request->all();

                    $query->where('name', 'like', '%'.$request->search_value.'%');
                }
            })
            ->orderBy('name', 'asc')
            ->limit(100)
            ->get()
            ->each->setAppends([])
            ->groupBy('type');
    }

}
