<?php

namespace Rutatiina\FinancialAccounting\Http\Controllers;

use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;
use Rutatiina\FinancialAccounting\Models\FinancialAccountCategory;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\FinancialAccounting\Models\Txn;
use Rutatiina\FinancialAccounting\Services\FinancialAccountService;
use Yajra\DataTables\Facades\DataTables;

class AccountController extends Controller
{
    public function __construct()
    {
        //this is to see how tags work another one
        //A commit without a tag
        //commit 1
        //commit 2
    }

    public function index(Request $request)
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson())
        {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $query = Account::setCurrency(Auth::user()->tenant->base_currency)->query();
        $query->with('financial_account_category');
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
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        return [
            'pageTitle' => 'Create financial account',
            'pageAction' => 'Create',
            'url' => '/financial-accounts',
            'attributes' => (new Account)->rgGetAttributes(),
            'financialAccountTypes' => FinancialAccountCategory::all()->groupBy('title')
        ];
    }

    public function store(Request $request)
    {
        $store = FinancialAccountService::store($request);

        if ($store)
        {
            return [
                'status' => true,
                'messages' => ['Account successfully saved'],
                'callback' => route('financial-accounts.index', [], false)
            ];
        }
        else
        {
            return [
                'status' => false,
                'messages' => FinancialAccountService::$errors,
            ];
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson())
        {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $attributes = Account::find($id)->toArray();
        $attributes['_method'] = 'PATCH';

        $data = [
            'pageTitle' => 'Edit financial account',
            'pageAction' => 'Edit',
            'url' => '/financial-accounts/' . $id, #required
            'attributes' => $attributes,
            'financialAccountTypes' => FinancialAccountCategory::all()->groupBy('title')
        ];

        return $data;
    }

    public function update(Request $request)
    {
        $store = FinancialAccountService::update($request);

        if ($store)
        {
            return [
                'status' => true,
                'messages' => ['Account successfully updated'],
            ];
        }
        else
        {
            return [
                'status' => false,
                'messages' => FinancialAccountService::$errors,
            ];
        }
    }

    public function destroy($id)
    {
        $destroy = FinancialAccountService::destroy($id);

        if (!$destroy)
        {
            return [
                'status' => false,
                'messages' => FinancialAccountService::$errors,
            ];
        }
        else
        {
            return [
                'status' => true,
                'messages' => ['Account deleted'],
            ];
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
