@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Estimate :: Copy')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/txn.js') }}"></script>
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/estimate.js') }}"></script>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h1 class="no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Estimate
                        <small>Copy estimate</small>
                    </h1>
                </div>
            </div>

        </div>


        <!-- Content area -->
        <div class="content no-border no-padding">

            <!-- Form horizontal -->
            <div class="panel panel-flat no-border no-shadow no-padding">

                <div class="panel-body no-padding">

                    <form id="txn_form" action="{{route('accounting.sales.estimates.store')}}" method="post" class="form-horizontal" style="margin-bottom: 100px;" data-edit="true">

                        @csrf
                        @method('POST')

                        <input type="hidden" name="submit" value="1" />
                        <input type="hidden" name="id" value="{{$txn->id}}" />
                        <input type="hidden" name="contact_name" value="{{optional($txn->debit_contact)->name or ''}}" />
                        <input type="hidden" name="internal_ref" value="{{$txn->internal_ref}}" />
                        <input type="hidden" name="quote_currency" value="{{$tenant->base_currency}}" />

                        <input type="submit" name="the_submit_btn" value="" style="display:none;" />

                        <fieldset class="" style="background: #fcfcfc; border-top: 1px solid #ddd; border-bottom: 1px solid #eee;">

                            <div class="form-group">
                                <div class="max-width-1040">
                                    <label class="control-label col-lg-2">Customer</label>
                                    <div class="col-lg-5">
                                            <select class="select-search" name="contact_id" data-placeholder="Select customer ..." data-allow-clear="true" data-value="{{--default-value--}}">
                                                <option></option>
                                                @foreach($contacts as $category => $_contacts)
                                                    <optgroup label="{{$category}}">
                                                        @foreach($_contacts as $contact)
                                                            <option value="{{$contact->id}}" {{ $contact->id == optional($txn->debit_contact)->id ? 'selected' : ''}}
                                                                    data-currency="{{$contact->currency}}"
                                                                    data-exchange_rates="{{json_encode(RgForex::contactExchangeRate($contact))}}"
                                                                    data-currencies="{{ implode(',', $contact->currencies)}}" {{ $contact->id == optional($txn->debit_contact)->id ? 'selected' : ''}}>{{$contact->display_name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                    </div>

                                    <div id="contact_currency" class="col-lg-1 no-padding {{(empty(optional($txn->debit_contact)->currency))? 'hidden' : '' }}">
                                        <div class="input-group">
                                            <select id="base_currency" name="base_currency" class="select input-roundless no-border-left">
                                                <option value="{{$txn->debit_contact->currency}}" {{($txn->debit_contact->currency == $txn->base_currency ) ? 'selected' : ''}} data-exchange_rate="{{RgForex::exchangeRate($tenant->base_currency, $txn->debit_contact->currency)}}">{{$txn->debit_contact->currency}}</option>
                                                @foreach($txn->debit_contact->currencies as $currency)
                                                    <option value="{{$currency}}" {{($currency == $txn->base_currency ) ? 'selected' : ''}} data-exchange_rate="{{RgForex::exchangeRate($tenant->base_currency, $currency)}}">{{$currency}}</option>
                                                @endforeach
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
                            </div>

                        </fieldset>

                        <fieldset class="">

                            <div class="form-group">
                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label">
                                        Estimate Number:
                                    </label>
                                    <div class="col-lg-4">
                                        <input type="text" name="number" value="{{$txn->number}}" class="form-control input-roundless" placeholder="Offer number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label">
                                        Reference:
                                    </label>
                                    <div class="col-lg-4">
                                        <input type="text" name="reference" value="{{$txn->reference}}" class="form-control input-roundless" placeholder="Enter reference">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <div class="max-width-1040">
                                    <label class="col-lg-2 control-label">
                                        Estimate Date:
                                    </label>
                                    <div class="col-lg-4">
                                        <input type="text" name="date" value="{{$txn->date}}" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-addon label-roundless">Expiry date:</span>
                                            <input type="text" name="expiry_date" value="{{$txn->expiry_date}}" class="form-control input-roundless daterange-single" placeholder="Expiry date" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </fieldset>
                        <!--<div class="max-width-1040 clearfix ml-20" style="border-bottom: 1px solid #ddd;"></div>-->


                        @include('accounting::txn_recurring_fields')

                        <fieldset class="">
                            <div class="form-group">
                                <div class="max-width-1040">
                                    <table class="table table-bordered no-border-left no-border-right no-border-bottom">
                                        <thead class="thead-default">
                                        <tr>
                                            <th width="49.66666667%" class="p-10 rg-eee text-bold">Item / description</th>
                                            <th width="8%" class="p-10 rg-eee text-right text-bold">Quantity</th>
                                            <th width="11%" class="p-10 rg-eee text-right text-bold">Rate</th>
                                            <th width="13%" class="p-10 rg-eee text-bold">Tax</th>
                                            <th width="auto" class="p-10 rg-eee text-right text-bold">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody id="items_field_rows">

                                        <tr class="items_row_template hidden">
                                            <td class="td_item_selector no-padding rg_select2_border_none">
                                                <select class="item_row_item rg_item_selector"
                                                        name="items[_index_][type_id]"
                                                        multiple
                                                        data-row=""
                                                        data-allow-clear="true"
                                                        data-url="{{route('items.select2-data.sales')}}">
                                                    <option></option>
                                                </select>
                                                <div class="ml-10 mr-10">
                                                    <textarea name="items[_index_][description]"
                                                              rows="1"
                                                              class="item_row_description hidden form-control input-roundless mb-5"
                                                              onkeyup="rg_auto_grow(this);"
                                                              placeholder="Description"
                                                              style="min-height: 30px;overflow: hidden;"></textarea>
                                                </div>
                                            </td>
                                            <td class="no-padding"><input type="text" name="items[_index_][quantity]" class="item_row_quantity form-control no-border text-right" value="1"></td>
                                            <td class="no-padding"><input type="text" name="items[_index_][rate]" class="item_row_rate form-control m-input no-border text-right" value="0"></td>
                                            <td class="no-padding">
                                                <select class="item_row_tax rg_tax_selector" multiple data-row="" data-minimum-Results-For-Search="-1" data-placeholder="Select" data-allow-clear="true">
                                                    @foreach($taxes as $tax)
                                                        <option value="{{$tax->value}}" data-id="{{$tax->id}}" data-method="{{$tax->method}}" title="{{ucfirst($tax->method)}}">{{$tax->display_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="no-padding">
                                                <div style="position: relative">
                                                    <input type="text" name="items[_index_][total]" class="item_row_total form-control no-border text-right" placeholder="0.00">
                                                    <div class="item_delete_btn">
                                                        <a href="" data-row="" class="item_row_delete badge badge-danger"><i class="icon-cross2 small text-bold"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        @foreach($txn->items as $key => $item)
                                            @continue (in_array($item->type, ['txn', 'txn_type', 'tax']))
                                            <tr id="row_{{$key}}">
                                                <td class="td_item_selector no-padding rg_select2_border_none">
                                                <select class="item_row_item rg_item_selector"
                                                        multiple
                                                        data-value="{{(empty($item->type)) ? $item->name : $item->type_id}}"
                                                        name="items[{{$key}}][type_id]"
                                                        data-row="{{$key}}"
                                                        {{--data-url="{{route('items.select2-data.sales')}}"--}}>
                                                    @if (empty($item->type) && $item->name) { ?>
                                                      <option selected>{{$item->name}}</option>
                                                    @endif
                                                </select>
                                                <div class="ml-10 mr-10">
                                                    <textarea name="items[{{$key}}][description]"
                                                              rows="1"
                                                              data-row="{{$key}}"
                                                              class="item_row_description form-control input-roundless mb-5"
                                                              onkeyup="rg_auto_grow(this);"
                                                              placeholder="Description"
                                                              style="min-height: 30px;overflow: hidden;">{{$item->description}}</textarea>
                                                </div>
                                            </td>
                                            <td class="no-padding"><input type="text" data-row="{{$key}}" name="items[{{$key}}][quantity]" class="item_row_quantity form-control no-border text-right" value="{{floatval($item->quantity)}}"></td>
                                            <td class="no-padding"><input type="text" data-row="{{$key}}" name="items[{{$key}}][rate]" class="item_row_rate form-control m-input no-border text-right {{floatval($item->rate)}}" value="{{floatval($item->rate)}}"></td>
                                            <td class="no-padding">
                                                <select class="item_row_tax rg_tax_selector" multiple data-row="{{$key}}" data-minimum-Results-For-Search="-1" data-placeholder="Select" data-allow-clear="true">
                                                    @foreach($taxes as $tax)
                                                        <option value="{{$tax->value}}" {{(in_array($tax->id, $item->taxes)) ? 'selected' : ''}} data-id="{{$tax->id}}" data-method="{{$tax->method}}" title="{{ucfirst($tax->method)}}">{{$tax->display_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="no-padding">
                                                <div style="position: relative">
                                                    <input type="text" data-row="{{$key}}" name="items[{{$key}}][total]" value="{{number_format($item->total, $tenant->decimal_places)}}" class="item_row_total form-control no-border text-right" placeholder="0.00">
                                                    <div class="item_delete_btn">
                                                        <a href="" data-row="" class="item_row_delete badge badge-danger"><i class="icon-cross2 small text-bold"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                            </tr>
                                        @endforeach

                                        </tbody>

                                        <tbody>
                                        <tr>
                                            <td class="no-border text-bold"><a href="javascript:rg_txn.new_item();">+ Add another line</a></td>
                                            <td class="pl-15 no-border-left no-border-top no-border-right text-bold" colspan="2">Sub Total</td>
                                            <td id="txn_subtotal" class="no-border-left no-border-top no-border-right text-right pr-10" colspan="2">{{number_format($txn->taxable_amount, $tenant->decimal_places)}}</td>
                                        </tr>
                                        </tbody>

                                        <tbody id="txn_totals" class="no-border">

                                        </tbody>

                                        <tfoot>

                                            <tr>
                                                <td class="p-15 no-border"></td>
                                                <td class="p-15 no-border-right text-bold size4of5" colspan="2">TOTAL (<span id="txn_base_currency">{{$txn->base_currency}}</span>)</td>
                                                <td id="txn_total" class="no-border-left text-bold size4of5 text-right pr-10" colspan="2">{{number_format($txn->total, $tenant->decimal_places)}}</td>
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

                                    <div class="col-md-7 pl-20" >
                                        <div class="row mb-10">
                                            <div class="col-12">
                                                <label class="label-roundless">Customer notes:</label>
                                                <textarea name="contact_notes" class="form-control input-roundless" rows="2" placeholder="Customer notes">Thanks for your business.</textarea>

                                                <div class="pb-20"> </div>
                                                <label class="label-roundless">Terms and conditions:</label>
                                                <textarea name="terms_and_conditions" class="form-control input-roundless" rows="2" placeholder="Mention your company's Terms and Conditions."></textarea>

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
            <div class="navbar navbar-default" style="position: fixed; bottom: 0px; left: 270px; right: 10px; width: auto; border-top: 2px solid #ddd; z-index:9;">
                <ul class="nav navbar-nav no-border visible-xs-block">
                    <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second"><i class="icon-circle-up2"></i></a></li>
                </ul>

                <div class="navbar-collapse collapse" id="navbar-second">

                    <div class="navbar-text">

                        <div class="btn-group dropup btn-xs btn-group-animated no-padding mr-20">
                            <button type="button" class="btn btn-danger btn-xs pr-20 pl-20 submit_txn_form" data-onsuccess="{{route('accounting.sales.estimates.show', $txn->id)}}" data-reset_form="false"><i class="icon-books position-left"></i> Create {{$entree->name}}</button>
                            {{--
                            <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="" class="submit_txn_form" data-onsuccess="send" data-reset_form="true"><i class="icon-screen-full"></i> Save and send</a></li>
                                <li><a href="" class="submit_txn_form" data-onsuccess="view" data-reset_form="false"><i class="icon-mail5"></i> Save and view</a></li>
                                <li class="divider"></li>
                                <li><a href="" class="submit_txn_form" data-onsuccess="draft" data-reset_form="false"><i class="icon-gear"></i> Save as draft</a></li>
                            </ul>
                            --}}
                        </div>

                    </div>

                    {{--
                    <div class="navbar-text pull-right">
                        <button type="button" onclick="rg_txn.show_recurring();" class="btn btn-link btn-xs text-bold"><i class="icon-comment-discussion position-left"></i> Make recurring</button>
                    </div>
                    --}}

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