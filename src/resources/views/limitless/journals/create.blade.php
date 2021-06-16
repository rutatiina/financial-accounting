@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Accounting :: Journals :: Create')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/journal.js') }}"></script>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h1 class="no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Journal
                        <small>Invoices for products sold or services to contact(s).</small>
                    </h1>
                </div>
            </div>

        </div>


        <!-- Content area -->
        <div class="content no-padding">

            <!-- Form horizontal -->
            <div class="panel panel-flat no-border no-shadow no-padding no-border-radius">

                <div class="panel-body no-padding">

                    <form id="txn_form"
                          action="{{route('accounting.journals.index')}}"
                          method="post"
                          class="form-horizontal"
                          style="margin-bottom: 100px;">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="submit" value="1" />
                        <input type="hidden" name="contact_name" value="" />
                        <input type="hidden" name="internal_ref" value="" />
                        <input type="hidden" name="base_currency" value="{{$tenant->base_currency}}" />
                        <input type="hidden" name="on_submit" value="" />

                        <input type="hidden" name="contact_id" value="" />
                        <input type="hidden" name="number" value="" />
                        <input type="hidden" name="quote_currency" value="{{$tenant->base_currency}}" />

                        <fieldset id="fieldset_select_contact" class="select_contact_required">

                            <div class="form-group">
                                <div class="max-width-1040">
                                    <div class="row">
                                        <label class="control-label col-lg-2 text-danger">* Customer</label>
                                        <div class="col-lg-5">
                                            <select class="select-search" name="contact_id" data-placeholder="Select customer ..." data-allow-clear="true" data-value="{{--default-value--}}">
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

                                        <div id="contact_currency" class="col-lg-1 no-padding {{(empty(optional($txn->debit_contact)->currency))? 'hidden' : '' }}">
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
                                                <input type="text" name="exchange_rate" value="{{optional($txn)->exchange_rate or 1}}" class="form-control input-roundless" placeholder="Exchange rate">
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
                                        Date:
                                    </label>
                                    <div class="col-lg-4">
                                        <input type="text" name="date" value="{{$txn->date}}" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label">
                                        Reference:
                                    </label>
                                    <div class="col-lg-4">
                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Enter reference">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label">
                                        Notes:
                                    </label>
                                    <div class="col-lg-4">
                                        <textarea type="text" name="note" class="form-control input-roundless" placeholder="Max 250 charaters"></textarea>
                                    </div>
                                </div>

                            </div>

                        </fieldset>

                        @include('accounting::txn_recurring_fields')

                        <fieldset class="">
                            <div class="form-group">
                                <div class="max-width-1040">
                                    <table class="table table-bordered no-border-left no-border-right no-border-bottom">
                                        <thead class="thead-default">
                                        <tr>
                                            <th width="25%" class="p-10 rg-eee text-bold">Account</th>
                                            <th width="27%" class="p-10 rg-eee text-left text-bold">Description</th>
                                            <th width="24%" class="p-10 rg-eee text-bold">Contact</th>
                                            <th width="12%" class="p-10 rg-eee text-right text-bold">Debit</th>
                                            <th width="12%" class="p-10 rg-eee text-right text-bold">Credit</th>
                                        </tr>
                                        </thead>
                                        <tbody id="items_field_rows">

                                        <tr class="items_row_template hidden">
                                            <td class="td_item_selector no-padding rg_select2_border_none">
                                                <select name="items[_index_][type_id]"
                                                        class="item_row_item rg_item_selector"
                                                        data-row=""
                                                        data-allow-clear="true"
                                                        data-url="{{route('items.select2-data.accounts')}}">
                                                    <option></option>
                                                </select>
                                            </td>
                                            <td class="td_item_selector no-padding rg_select2_border_none">
                                                <textarea name="items[_index_][description]"
                                                              rows="1"
                                                              class="item_row_description form-control input-roundless no-border"
                                                              onkeyup="rg_auto_grow(this);"
                                                              placeholder="Description"
                                                              style="min-height: 30px;overflow: hidden;"></textarea>

                                            </td>
                                            <td class="no-padding">
                                                <select class="item_row_contact rg_contact_selector" name="items[_index_][contact_id]" data-placeholder="Select contact ..." data-allow-clear="true">
                                                    <option></option>
                                                    @foreach($contacts as $category => $_contacts)
                                                        <optgroup label="{{$category}}">
                                                            @foreach($_contacts as $contact)
                                                                <option value="{{$contact->id}}" data-currency="{{$contact->currency}}" data-exchange_rates="{{json_encode(RgForex::contactExchangeRate($contact))}}" data-currencies="{{ implode(',', $contact->currencies)}}" {{ $contact->id == optional($txn->debit_contact)->id ? 'selected' : ''}}>{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="no-padding">
                                                <div style="position: relative">
                                                    <input type="text" name="items[_index_][debit]" class="item_row_debit form-control no-border text-right" placeholder="0.00">
                                                </div>
                                            </td>
                                            <td class="no-padding">
                                                <div style="position: relative">
                                                    <input type="text" name="items[_index_][credit]" class="item_row_credit form-control no-border text-right" placeholder="0.00">
                                                    <div class="item_delete_btn">
                                                        <a href="" data-row="" class="item_row_delete badge badge-danger"><i class="icon-cross2 small text-bold"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        </tbody>

                                        <tbody>

                                        <tr>
                                            <td class="no-border text-bold" colspan="2"><a href="javascript:rg_txn.new_item();">+ Add another line</a></td>
                                            <td class="pl-15 no-border-left no-border-top no-border-right text-bold">Sub Total</td>
                                            <td id="txn_subtotal" class="no-border-left no-border-top no-border-right text-right pr-10" colspan="2">0.00</td>
                                        </tr>
                                        </tbody>

                                        <tbody id="txn_totals" class="no-border">

                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <td class="p-15 no-border" colspan="2"></td>
                                            <td class="p-15 no-border-right text-bold size4of5">TOTAL (UGX)</td>
                                            <td id="txn_total" class="no-border-left text-bold size4of5 text-right pr-10" colspan="2">0.00</td>
                                        </tr>

                                        <tr id="txn_exchange_rate" style="display:none;">
                                            <td class="p-15 no-border"></td>
                                            <td class="no-border no-padding-left no-padding-right" colspan="2" style="white-space:nowrap;">
                                                <label class="col-lg-6 control-label text-left">
                                                Exchange rate:
                                                </label>
                                                <div class="col-lg-6 no-padding">
                                                    <input type="text" name="exchange_rate" value="1" class="form-control input-roundless text-right no-padding-top no-padding-bottom pl-10 pr-10" placeholder="Exchange rate">
                                                </div>
                                            </td>
                                            <td id="txn_exchange_amount" class="no-border text-right pr-10" colspan="2">0.00</td>
                                        </tr>

                                        </tfoot>

                                    </table>
                                </div>
                            </div>
                        </fieldset>
                        <div class="max-width-1040 clearfix ml-20" style="border-bottom: 1px solid #ddd;"></div>

                        <fieldset class=""><!-- #FBFAFA -->
                            <div class="form-group" >
                                <div class="max-width-1040">

                                    <div class="col-md-5 pl-20" >
                                        <div class="row">
                                            <div class="col-12">

                                                @include('accounting::txn_attach_files_fields')

                                            </div>
                                        </div>
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

                        <button type="button" class="btn btn-danger btn-labeled btn-xs pr-15 submit_txn_form" data-onsuccess=""><b><i class=" icon-cloud-check"></i></b> Save journal </button>

                    </div>

                    <!--<div class="navbar-text pull-right">
                        <button type="button" onclick="rg_txn.show_recurring();" class="btn btn-link btn-xs text-bold"><i class="icon-comment-discussion position-left"></i> Make recurring</button>
                    </div>-->

                </div>
            </div>
            <!-- /footer -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->
@endsection

