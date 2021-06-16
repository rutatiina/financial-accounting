@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Payment :: Create / Add')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/txn.js') }}"></script>
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/payment.js') }}"></script>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h1 class="no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Payment
                        <small>Payment Or Forex gain/loss on bill</small>
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

                    <form id="txn_form" action="{{route('accounting.purchases.payments.store')}}" method="post" class="form-horizontal" style="margin-bottom: 100px;">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="submit" value="1" />
                        <input type="hidden" name="id" value="{{$txn->id}}" />
                        <input type="hidden" name="contact_name" value="{{optional($txn->debit_contact)->name or ''}}" />
                        <input type="hidden" name="internal_ref" value="{{$txn->internal_ref}}" />
                        <input type="hidden" name="base_currency" value="{{$tenant->base_currency}}" />
                        <input type="hidden" name="on_submit" value="" />

                        <input type="hidden" name="quote_currency" value="{{$tenant->base_currency}}" />

                        <fieldset id="fieldset_select_contact" class="select_contact_required">

                            <div class="form-group">
                                <div class="max-width-1040">
                                    <div class="row">
                                        <label class="control-label col-lg-2 text-danger">* Supplier / vendor</label>
                                        <div class="col-lg-5">
                                            <select class="select-search" name="contact_id" data-placeholder="Select supplier / vendor ..." data-allow-clear="true" data-bills-url="{{route('accounting.purchases.payments.bills')}}">
                                                <option></option>
                                                @foreach($contacts as $category => $_contacts)
                                                    <optgroup label="{{$category}}">
                                                        @foreach($_contacts as $contact)
                                                            <option value="{{$contact->id}}" data-currency="{{$contact->currency}}" data-exchange_rates="{{json_encode(RgForex::contactExchangeRate($contact))}}" data-currencies="{{ implode(',', $contact->currencies)}}">{{$contact->display_name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="contact_currency" class="col-lg-1 no-padding-left {{(empty($txn->contact->currency)) ? 'hidden' : ''}}">
                                            <div class="input-group">
                                                <select id="base_currency" name="base_currency" class="select input-roundless no-border-left">
                                                    @if(optional($txn->contact)->currency)
                                                        @foreach($txn->contact->currency as $quote_currency)
                                                            <option value="{{$quote_currency}}" {{($quote_currency == $txn->quote_currency ) ? 'selected' : ''}}>{{$quote_currency}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div id="txn_exchange_rate" class="col-lg-3 no-padding-left" style="display:none;">
                                            <div class="input-group">
                                                <span class="input-group-addon label-roundless">Exchange rate:</span>
                                                <input type="text" name="exchange_rate" value="1" class="form-control input-roundless" placeholder="Exchange rate">
                                            </div>
                                        </div>

                                        <div id="change_of_contact" class="col-lg-4" style="line-height: 35px; display:none;">
                                            <span>Loading contact details ...</span>
                                        </div>
                                    </div>

                                    <div id="contact_required_message" class="row mt-5 hidden">
                                        <div class="col-lg-2"> </div>
                                        <div class="col-lg-10 text-danger">* Warning! Please choose customer.</div>
                                    </div>

                                </div>
                            </div>

                        </fieldset>

                        <fieldset class="">

                            <div class="form-group">
                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label">
                                        Payment Number:
                                    </label>
                                    <div class="col-lg-2">
                                        <input type="text" name="number" value="{{$txn->number}}" class="form-control input-roundless" placeholder="Payment number">
                                    </div>

                                    <div class="input-group col-lg-2 pr-10">
                                        <span class="input-group-addon label-roundless">Ref</span>
                                        <input type="text" name="reference" value="{{$txn->reference}}" class="form-control input-roundless" placeholder="Reference" title="Reference">
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label">
                                        Amount paid
                                    </label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon label-roundless">{{$tenant->base_currency}}</span>
                                            <input type="text" name="total" value="{{$txn->total}}" class="form-control input-roundless" placeholder="Amount paid">
                                        </div>
                                    </div>
                                    <div id="auto_pay_txns" class="col-lg-4">
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="auto_pay"> Auto pay bill(s)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label">
                                        Payment date
                                    </label>
                                    <div class="col-lg-4">
                                        <input type="text" name="date" value="{{$txn->date ? $txn->date : (date('Y-m-d'))}}" class="form-control input-roundless daterange-single" placeholder="Payment date">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label">Payment Account:</label>
                                    <div class="col-lg-4">
                                        <select class="select-search" name="credit" data-placeholder="Select Account ..." data-allow-clear="true">
                                            <option value=""></option>
                                            @foreach($bankAccounts as $bankAccount)
                                                <option value="{{$bankAccount->account_id}}">{{$bankAccount->name . ' - ' . $bankAccount->number . ' - ' . $bankAccount->bank}}</option>
                                            @endforeach

                                            @foreach($accounts as $account)
                                                @if ($account['type'] == 'asset')
                                                    <option value="{{$account->code}}" {{($account->code == 3) ? 'selected' : ''}}>{{$account->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>


                        </fieldset>
                        <div class="max-width-1040 clearfix ml-20" style="border-bottom: 1px solid #ddd;"></div>

                        <fieldset class="no-padding-top">

                            <div class="form-group">
                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label"> <!--Unpaid Bills--> </label>
                                    <div class="col-lg-4">
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="no_txns" name="no_txns" value="true"> No bill(s) recived yet.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="contact_txns_table" class="form-group">
                                <div class="max-width-1040">
                                    <table class="table">
                                        <thead class="thead-default">
                                        <tr>
                                            <th width="" class="h6">Date / <span class="text-muted text-size-small">Due</span></th>
                                            <th width="" class="h6">Bill#  <small class="pull-right pt-5"><a href="" class="pay_all_fully">(Pay all fully)</a></small></th>
                                            <th width="" class="h6 text-right">Bill amount</th>
                                            <th width="" class="h6 text-right">Amount due</th>
                                            <th width="" class="h6 text-left">Amount paid <small class="pull-right pt-5"><a href="" class="clear_amounts">(Clear amounts)</a></small></th>
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
                                            <td class="p-15 no-border-right text-bold size4of5">Amount paid</td>
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
                        </fieldset>
                        <div class="max-width-1040 clearfix ml-20" style="border-bottom: 1px solid #ddd;"></div>


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
                            <button type="button" onclick="rg_payment.on_submit('');" class="btn btn-danger  btn-xs pr-20 pl-20"><i class="icon-cog5 position-left"></i> Create {{$entree->name}}</button>
                        </div>

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
        .max-width-1040 {
            max-width: 1040px;
        }
    </style>

@endsection