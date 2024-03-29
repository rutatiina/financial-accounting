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
        $this->middleware('permission:chat-of-accounts.view');
        $this->middleware('permission:chat-of-accounts.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:chat-of-accounts.update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:chat-of-accounts.delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson())
        {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $paginate = 20;

        $query = Account::setCurrency(Auth::user()->tenant->base_currency)->query();
        $query->with('financial_account_category');
        $query->orderBy('name', 'asc');

        if ($request->search)
        {
            $paginate = Account::count();
            $request->request->remove('page');

            $query->where(function($q) use ($request) {
                $columns = (new Account)->getSearchableColumns();
                foreach($columns as $column)
                {
                    // $q->orWhere($column, 'like', '%'.Str::replace(' ', '%', $request->search).'%');
                }

                $q->orWhereHas('financial_account_category', function ($qq) use ($request) {
                    $qq->where('title', 'like', '%'.Str::replace(' ', '%', $request->search).'%');
                    // return $query->where(function($q) use ($request) {});
                    $qq->orWhere('category_name', 'like', '%'.Str::replace(' ', '%', $request->search).'%');
                    $qq->orWhere('description', 'like', '%'.Str::replace(' ', '%', $request->search).'%');
                });
            });
        }

        if ($request->account_with_balances && $request->account_with_balances != 'false')
        {
            $query->has('balances');
        }

        // return $query->toSql();

        $AccountPaginate = $query->paginate($paginate);

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
            'pageTitle' => 'Create Financial account',
            'pageAction' => 'Create',
            'url' => '/financial-accounts',
            'attributes' => (new Account)->rgGetAttributes(),
            'financialAccountTypes' => FinancialAccountCategory::all()->groupBy('title')
        ];
    }

    public function store(Request $request)
    {
        // return $request;
        
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

    public function byType(Request $request, $type)
    {
        $query = Account::query();
        $query->where('type', $type);

        if ($request->sub_type) $query->where('sub_type', $request->sub_type);

        return $query->paginate(50);
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
            ->whereIn('type', ['asset', 'expense', 'equity']) //'liability', was remove because Account payables is a liability
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
