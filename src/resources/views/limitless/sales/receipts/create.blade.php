@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Receipts :: Create / Add')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/txn.js') }}"></script>
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/receipt.js') }}"></script>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h1 class="no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Receipt
                        <small>Receipt Or Forex gain / loss on invoice and cash / direct receipts</small>
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

                    <form id="txn_form" action="{{route('accounting.sales.receipts.store')}}" method="post" class="form-horizontal" autocomplete="off" data-use-native-fields="true" style="margin-bottom: 100px;">

                        @csrf
                        @method('POST')

                        <input type="hidden" name="submit" value="1" />
                        <input type="hidden" name="id" value="{{$txn->id}}" />
                        <input type="hidden" name="contact_name" value="{{optional($txn->debit_contact)->name}}" />
                        <input type="hidden" name="internal_ref" value="{{$txn->internal_ref}}" />
                        <input type="hidden" name="quote_currency" value="{{$tenant->base_currency}}" />
                        <input type="hidden" name="on_submit" value="" />

                        <fieldset id="fieldset_select_contact" class="select_contact_required">

                            <div class="form-group">
                                <div class="max-width-1040">
                                    <div class="row">
                                        <label class="control-label col-lg-2 text-danger">* Choose Customer</label>
                                        <div class="col-lg-5">
                                            <select class="select-search" name="contact_id" data-placeholder="Select customer ..." data-allow-clear="true" data-value="{{optional($txn->debit_contact)->id or ''}}" data-invoices-url="{{route('accounting.sales.receipts.invoices')}}">
                                                <option></option>
                                                @foreach($contacts as $category => $_contacts)
                                                    <optgroup label="{{$category}}">
                                                        @foreach($_contacts as $contact)
                                                            <option value="{{$contact->id}}" data-currency="{{$contact->currency}}" data-exchange_rates="{{json_encode(RgForex::contactExchangeRate($contact))}}" data-currencies="{{ implode(',', $contact->currencies)}}" {{ $contact->id == optional($txn->debit_contact)->id ? 'selected' : ''}}>{{$contact->display_name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="contact_currency" class="col-lg-1 no-padding-left {{(empty(optional($txn->debit_contact)->currency)) ? 'hidden' : ''}}">
                                            <div class="input-group">
                                                <select id="base_currency" name="base_currency" class="select input-roundless no-border-left">
                                                    @if(optional($txn->debit_contact)->currency)
                                                        @foreach($txn->debit_contact->currencies as $currency)
                                                            <option value="{{$currency}}" data-exchange_rate="{{RgForex::exchangeRate($tenant->base_currency, $currency)}}" {{($currency == $txn->debit_contact->quote_currency ) ? 'selected' : ''}}>{{$currency}}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="{{$tenant->base_currency}}" data-exchange_rate="1">{{$tenant->base_currency}}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div id="txn_exchange_rate" class="col-lg-3 no-padding-left" style="display:none;">
                                            <div class="input-group">
                                                <span class="input-group-addon label-roundless">Exchange rate:</span>
                                                <input type="text" name="exchange_rate" value="{{optional($txn->exchange_rate) or 1}}" class="form-control input-roundless" placeholder="Exchange rate">
                                            </div>
                                        </div>

                                        <div id="change_of_contact" class="col-lg-4" style="line-height: 35px; display:none;">
                                            <span>Loading contact details ...</span>
                                        </div>

                                        <div id="contact_required_message" class="control-label col-lg-4 hidden">
                                            <label class="text-danger">!! Please choose customer.</label>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </fieldset>

                        <fieldset class="">

                            <div class="form-group">
                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label">
                                        Receipt Number:
                                    </label>
                                    <div class="col-lg-2">
                                        <input type="text" name="number" value="{{$txn->number}}" class="form-control input-roundless" placeholder="Invoice number">
                                    </div>

                                    <div class="input-group col-lg-2 pr-10">
                                        <span class="input-group-addon label-roundless">Ref</span>
                                        <input type="text" name="reference" value="{{$txn->reference}}" class="form-control input-roundless" placeholder="Reference" title="Reference">
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label">Amount received</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span id="txn_base_currency" class="input-group-addon label-roundless">{{$tenant->base_currency}}</span>
                                            <input type="text" name="total" value="{{$txn->total}}" class="form-control input-roundless text-semibold text-right" placeholder="Amount received">
                                        </div>
                                    </div>
                                    <div id="auto_pay_txns" class="col-lg-4">
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="auto_pay"> Auto pay invoice(s)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label">Payment date</label>
                                    <div class="col-lg-4">
                                        <input type="text" name="date" value="{{$txn->date ? $txn->date : (date('Y-m-d'))}}" class="form-control input-roundless daterange-single" placeholder="Payment date">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label">Payment mode:</label>
                                    <div class="col-lg-4">
                                        <select name="payment_mode" data-placeholder="Received Via" class="select-search" data-tag="true">
                                            <option value="Bank Deposit">Bank Deposit</option>
                                            <option value="Bank Remittance">Bank Remittance</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                            <option value="Cash" selected>Cash</option>
                                            <option value="Check">Check</option>
                                            <option value="Credit Card">Credit Card</option>
                                            <option value="Mobile money">Mobile money</option>
                                        </select>
                                    </div>

                                    <div class="input-group col-lg-6 {{(empty($bankAccounts)) ? 'hidden' : ''}}">
                                        <span class="input-group-addon label-roundless">Deposit to:</span>
                                        <select class="select-search" name="debit" data-placeholder="Deposit to ..." data-allow-clear="true">
                                            <option value=""></option>
                                            <optgroup label="Bank Accounts">
                                                @foreach($bankAccounts as $bankAccount)
                                                <option value="{{$bankAccount->financial_account_code}}">{{$bankAccount->name . ' - ' . $bankAccount->number . ' - ' . optional($bankAccount->bank)->name}}</option>
                                                @endforeach
                                            </optgroup>

                                            @foreach ($accounts as $type => $value)
                                                @continue(!in_array($type, ['asset','equity','liability']))
                                                <optgroup label="<?php echo $type; ?> Accounts">
                                                    @foreach ($value as $account)
                                                        @continue($account->bank_account_id)
                                                        <option value="{{$account->code}}" {{($account->code == 3) ? 'selected' : ''}}>{{$account->name}}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach

                                            {{--
                                            @foreach($accounts as $account)
                                            @if ($account->type == 'asset')
                                                <option value="{{$account->code}}" {{($account['id'] == 3) ? 'selected' : ''}}>{{$account->name}}</option>
                                            @endif
                                            @endforeach
                                            --}}
                                        </select>
                                    </div>

                                </div>

                            </div>

                            <div class="form-group">
                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label"> <!--Unpaid Invoices--> </label>
                                    <div class="col-lg-4">
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="no_txns" name="no_txns" value="true"> No invoice issued for sale.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </fieldset>
                        {{--<div class="max-width-1040 clearfix ml-20" style="border-bottom: 1px solid #ddd;"></div>--}}

                        <fieldset class="no-padding-top">

                            <div id="contact_txns_table" class="form-group">
                                <div class="max-width-1040">
                                    <div class="panel panel-flat no-margin-bottom">

                                        <div class="form-group no-margin-bottom mt-5">
                                            <label class="col-lg-2 control-label">Show invoices to:</label>
                                            <div class="col-lg-10" id="rg-select2-multiple">
                                                <select class="select-search" id="invoice_contact_ids" name="invoice_contact_ids[]" multiple data-placeholder="Select customer ..." data-allow-clear="true" data-value="{{optional($txn->debit_contact)->id or ''}}" data-invoices-url="{{route('accounting.sales.receipts.invoices')}}">
                                                    <option></option>
                                                    @foreach($contacts as $category => $_contacts)
                                                        <optgroup label="{{$category}}">
                                                            @foreach($_contacts as $contact)
                                                                <option value="{{$contact->id}}" data-currency="{{$contact->currency}}" data-exchange_rates="{{json_encode(RgForex::contactExchangeRate($contact))}}" data-currencies="{{ implode(',', $contact->currencies)}}" {{ $contact->id == optional($txn->debit_contact)->id ? 'selected' : ''}}>{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <hr class="no-margin">

                                        <table class="table">
                                        <thead class="thead-default">
                                        <tr>
                                            <th width="" class="h6">Date / <span class="text-muted text-size-small">Due</span></th>
                                            <th width="" class="h6">Invoice#  <small class="pull-right pt-5"><a href="" class="pay_all_fully">(Pay all fully)</a></small></th>
                                            <th width="" class="h6 text-right">Invoice amount</th>
                                            <th width="" class="h6 text-right">Amount due</th>
                                            <th width="" class="h6 text-left">Receipt amount <small class="pull-right pt-5"><a href="" class="clear_amounts">(Clear amounts)</a></small></th>
                                        </tr>
                                        </thead>
                                        <tbody id="contact_txns">

                                        @if (!isset($txn->id))
                                        <tr>
                                            <td class="text-center" colspan="5"><h4>Please select contact to continue</h4></td>
                                        </tr>
                                        @endif

                                        </tbody>

                                        <tfoot>

                                        <tr>
                                            <td class="text-bold" colspan="3"></td>
                                            <td class="pl-15 text-bold">Total due</td>
                                            <td id="txn_total_due" class="text-right">0.00</td>
                                        </tr>
                                        <tr>
                                            <td class="p-15 no-border" colspan="3"></td>
                                            <td class="p-15 no-border-right text-bold size4of5">Amount Received</td>
                                            <td id="txn_amount_received" class="no-border-left text-bold size4of5 text-right">0.00</td>
                                        </tr>
                                        <tr>
                                            <td class="p-15 no-border" colspan="3"></td>
                                            <td class="p-15 no-border-right text-bold size4of5 text-danger">Amount unallocated</td>
                                            <td id="txn_amount_unallocated" class="no-border-left text-bold size4of5 text-right text-danger">0.00</td>
                                        </tr>

                                        </tfoot>

                                    </table>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        {{--<div class="max-width-1040 clearfix ml-20" style="border-bottom: 1px solid #ddd;"></div>--}}

                        <fieldset class=""><!-- #FBFAFA -->
                            <div class="form-group" >
                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label">Upload documents:</label>
                                    <div class="col-lg-10">
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
            <div class="navbar navbar-default" style="position: fixed; bottom: 0px; left: 270px; right: 10px; width: auto; border-top: 2px solid #ddd;">
                <ul class="nav navbar-nav no-border visible-xs-block">
                    <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second"><i class="icon-circle-up2"></i></a></li>
                </ul>

                <div class="navbar-collapse collapse" id="navbar-second">

                    <div class="navbar-text">

                        <div class="btn-group dropup btn-xs btn-group-animated no-padding mr-20">
                            <button type="button" {{--onclick="rg_receipt.on_submit('');"--}} class="btn btn-danger submit_txn_form btn-xs pr-20 pl-20"><i class="icon-cog5 position-left"></i> Create {{$entree->name}}</button>
                        </div>

                        <button type="reset" class="btn btn-default btn-xs" onclick="$('#txn_form')[0].reset();"><i class="icon-cross2 position-left"></i> Cancel</button>

                    </div>

                    <!--<div class="navbar-text pull-right">
                        <button type="button" class="btn btn-link btn-xs text-bold"><i class="icon-comment-discussion position-left"></i> Make recurring</button>
                    </div>-->

                </div>
            </div>
            <!-- /footer -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

    <style>

        #txn_form #rg-select2-multiple .select2-selection__clear {
            display: none;
        }

        #txn_form #rg-select2-multiple .select2-selection--multiple .select2-selection__choice {
            background-color: transparent;
            border: 1px solid #ccc;
            color: #333333;
        }
        #rg-select2-multiple .select2-selection--single,
        #rg-select2-multiple .select2-selection--multiple
        {
            border-radius: 0 !important;
            border: none !important;
        }
        #rg-select2-multiple .select2-selection--multiple .select2-selection__choice {
            padding: 3px 12px;
        }
    </style>
@endsection
