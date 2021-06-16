@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Purchases :: Expense :: Copy')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/txn.js') }}"></script>
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/expense.js') }}"></script>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper" style="position: relative;">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h1 class="no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Expense
                        <small>Copy Expense</small>
                    </h1>
                </div>
            </div>

        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content no-border no-padding">

            <!-- Form horizontal -->
            <div class="panel panel-flat no-border no-shadow no-padding">

                <div class="panel-body no-padding">

                    <form id="txn_form" action="{{route('accounting.purchases.expenses.store')}}" method="post" class="form-horizontal" style="margin-bottom: 100px;">
                        @csrf
                        @method('POST')

                        <div id="row_0" class="on-reset-remove">

                            <input type="hidden" name="submit" value="1" />
                            <input type="hidden" name="contact_name" value="{{optional($txn->debit_contact)->name or ''}}" />
                            <input type="hidden" name="internal_ref" value="{{$txn->internal_ref}}" />
                            <input type="hidden" name="base_currency" value="{{$txn->base_currency}}" />
                            <input type="hidden" name="number" value="NULL" />
                            <input type="hidden" name="on_submit" value="" />

                            <input type="hidden" name="quote_currency" value="{{$txn->base_currency}}" />
                            <input type="hidden" name="exchange_rate" value="1" />

                            <fieldset class="" style="background: #fcfcfc; border-top: 1px solid #ddd; border-bottom: 1px solid #eee;">

                                <div class="form-group">

                                    <div class="form-group">

                                        <div class="max-width-1040">
                                            <label class="col-lg-2 control-label">
                                                 Date & Amount
                                            </label>
                                            <div class="col-lg-2">
                                                <input type="text" name="date" value="{{date('Y-m-d')}}" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon label-roundless">{{$txn->base_currency}}</span>
                                                    <input type="text" name="items[0][rate]" value="{{floatval($txn->items()->first()->total)}}" class="item_row_rate form-control input-roundless text-right" placeholder="0" data-row="0">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="max-width-1040">
                                            <label class="control-label col-lg-2">Expense account</label>
                                            <div class="col-lg-6">
                                                <select id="rg_item_selector_expense" class="select-search rg_item_selector"
                                                        name="debit"
                                                        data-placeholder="Expense Account ..."
                                                        data-allow-clear="true"
                                                        data-value="{{$txn->debit_financial_account_code}}"
                                                        data-row="0">
                                                    <option></option>
                                                    <optgroup label="Expense Accounts">
                                                        @foreach($accounts as $account)
                                                            @if ($account->type == 'expense')
                                                                <option value="{{$account->code}}" {{($account->code == $txn->debit_financial_account_code ) ? 'selected' :''}}>{{$account->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <input type="hidden" name="items[0][quantity]" value="1" class="item_row_quantity"/>
                                        <input type="hidden" name="items[0][discount]" value="0" class="item_row_discount">

                                        <div class="max-width-1040">
                                            <label class="col-lg-2 control-label">Tax & Tax Amount</label>
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon label-roundless">Tax</span>
                                                    <select name="tax_id" class="select-search rg_tax_selector" data-row="0" data-minimum-Results-For-Search="-1" data-placeholder="Select" data-allow-clear="true">
                                                        <option></option>
                                                        @foreach($taxes as $tax)
                                                            <option value="{{$tax->value}}" {{(in_array($tax->id, $txn->items()->first()->taxes)) ? 'selected' : ''}} data-id="{{$tax->id}}" data-method="{{$tax->method}}" title="{{ucfirst($tax->method)}}">{{$tax->display_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 no-padding-left">
                                                <div class="input-group">
                                                    <span class="input-group-addon label-roundless"><small>{{$tenant->base_currency}}</small></span>
                                                    <input type="text" name="items[0][tax][total]" value="{{floatval(@$txn->items[1]->total)}}" class="form-control input-roundless text-right _tax_amount_" placeholder="0" data-row="0">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 control-label">
                                                <div id="expense_tax_summary" class="control-label"></div>
                                            </div>

                                        </div>

                                        <div class="clearfix"></div>

                                    </div>

                                    <div class="form-group">

                                        <div class="max-width-1040">
                                            <label class="control-label col-lg-2">Paid through</label>
                                            <div class="col-lg-6">
                                                <select name="credit" class="select-search" data-placeholder="Payment Account ..." data-allow-clear="true">
                                                    <optgroup label="Payment Accounts">
                                                        @foreach($accounts as $account)
                                                            @if ($account->payment == 1)
                                                                <option value="{{$account->code}}" {{($account->code == $txn->credit_financial_account_code ) ? 'selected' :''}}>{{$account->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </fieldset>

                            @include('accounting::txn_recurring_fields')

                            <fieldset id="fieldset_select_contact">

                                <div class="form-group">
                                    <div class="max-width-1040">
                                        <label class="control-label col-lg-2">Supplier / Vendor</label>
                                        <div class="col-lg-5">
                                            <select class="select-search" name="contact_id" data-placeholder="Select supplier or vendor" data-allow-clear="true">
                                                <option></option>
                                                @foreach($contacts as $category => $_contacts)
                                                    <optgroup label="{{$category}}">
                                                        @foreach($_contacts as $contact)
                                                            <option value="{{$contact->id}}" {{ $contact->id == $txn->debit_contact_id ? 'selected' : ''}}
                                                                data-currency="{{$contact->currency}}"
                                                                data-exchange_rates="{{json_encode(RgForex::contactExchangeRate($contact))}}"
                                                                data-currencies="{{ implode(',', $contact->currencies)}}" >{{$contact->display_name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>

                            <fieldset>

                                <div class="form-group">

                                    <div class="max-width-1040">
                                        <label class="col-lg-2 control-label">
                                            Reference#
                                        </label>
                                        <div class="col-lg-5">
                                            <input type="text" name="reference" value="{{$txn->reference}}" class="form-control input-roundless" placeholder="Enter reference">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="max-width-1040">
                                        <label class="col-lg-2 control-label">
                                            Description
                                        </label>
                                        <div class="col-lg-5">
                                            <textarea name="items[0][description]" data-row="0" class="form-control input-roundless item_row_description" placeholder="Description">{{$txn->items->first()->description}}</textarea>
                                        </div>
                                    </div>

                                </div>

                            </fieldset>

                        </div><!-- End of div row_0 -->

                        <!--<div class="max-width-1040 clearfix ml-20" style="border-bottom: 1px solid #ddd;"></div>-->
                        <fieldset>
                            <div class="form-group">
                                <div class="max-width-1040">
                                    <div class="col-lg-12">
                                        @include('accounting::txn_attach_files_fields')
                                    </div>
                                </div>
                            </div>
                        </fieldset>


                    </form>

                </div>
            </div>
            <!-- /form horizontal -->


            <!-- Footer -->
            <div class="navbar navbar-default" style="position: absolute; bottom: 0px; left: 0px; right: 10px; width: 100%; border-top: 2px solid #ddd;">
                <ul class="nav navbar-nav no-border visible-xs-block">
                    <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second"><i class="icon-circle-up2"></i></a></li>
                </ul>

                <div class="navbar-collapse collapse" id="navbar-second">

                    <div class="navbar-text">
                        <button type="button" class="btn btn-danger btn-xs pr-20 mr-10 submit_txn_form" data-onsuccess=""><i class="icon-cloud-check2 position-left"></i> Create {{$entree->name}} </button>
                    </div>

                </div>
            </div>
            <!-- /footer -->

        </div>
        <!-- /content area -->


    </div>
    <!-- /main content -->

    <style>
        .max-width-1040 {
            max-width: 1040px;
        }
    </style>

@endsection
