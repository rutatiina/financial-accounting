@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Taxe :: Create')

@section('content')

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #ddd;">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <h1 class="pull-left no-margin text-light">
                        <i class="icon-file-plus position-left"></i> New Item
                        <small>New Item</small>
                    </h1>

                    <div class="pull-right">

                        <div class="btn-group btn-xs btn-group-animated no-padding mr-20">
                            <button type="button" class="btn btn-danger btn-labeled pr-20 import_btn" class="label bg-blue-400" data-import="items" data-url="{{route('items.import')}}">
                                <b><i class="icon-download4"></i></b> Import items
                            </button>
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><span
                                        class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="{{asset('import_templates/import_items.xlsx')}}">
                                        <i class="icon-file-download"></i> Download template
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content">

            <!-- Pagination types -->
            <div class="panel panel-flat no-border no-shadow mt-20">

                <div class="panel-body">

                    <form id="form_taxes_create"
                          action="{{route('accounting.settings.taxes.store')}}"
                          method="post"
                          class="rg-item-form rg-form-ajax-submit">
                        @csrf
                        @method('POST')

                        <div class="col-md-7">

                            <fieldset>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="input-group">
                                                <span class="input-group-addon label-roundless">Display name:</span>
                                                <input type="text" name="display_name" value="" class="form-control input-roundless" placeholder="Display name">
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <span class="input-group-addon label-roundless">Name:</span>
                                                <input type="text" name="name" value="" class="form-control input-roundless" placeholder="Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="input-group">
                                                <span class="input-group-addon label-roundless">Value:</span>
                                                <input type="text" name="value" value=""
                                                       class="form-control input-roundless" placeholder="E.g. 18% or 2000"
                                                       aria-describedby="basic-addon1">

                                                <span class="input-group-addon label-roundless no-border-left">{{$tenant->base_currency}}</span>
                                                <input type="hidden" name="selling_currency" value="{{$tenant->base_currency}}">

                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="input-group">
                                                <span class="input-group-addon label-roundless" id="basic-addon1">
                                                    Based On:
                                                </span>
                                                <select name="based_on" class="select input-roundless" data-placeholder="Based On">
                                                    <option value=""></option>
                                                    <option value="item">Item</option>
                                                    <option value="total">Total</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="input-group">
                                                <span class="input-group-addon label-roundless" id="basic-addon1">
                                                    Method:
                                                </span>
                                                <select name="method" class="select input-roundless" data-placeholder="Method">
                                                    <option value=""></option>
                                                    <option value="inclusive">Inclusive</option>
                                                    <option value="exclusive">Exclusive</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </fieldset>

                        </div>

                        <div class="clearfix"></div>

                        <!--<hr class="no-margin-top" />-->

                        <div class="form-group col-md-7">

                            <div class="row">

                                <!-- OPEN: Sales information -->
                                <div class="col-md-6">

                                    <div class="form-group clearfix">
                                        <span class="label label-success">On Sales</span>
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox checkbox-switchery switchery-xs">
                                            <label>
                                                <input type="checkbox" class="switchery" checked="checked" name="on_sale" value="bank_charge">
                                                Tax is applied on Sales - effect of tax when making sales.
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix" title="On Sale Effect">
                                        <div class="input-group">
                                            <span class="input-group-addon label-roundless" id="basic-addon1">
                                                Effect:
                                            </span>
                                            <select name="on_sale_effect" class="select input-roundless" data-placeholder="Select effect">
                                                <option value=""></option>
                                                <option value="debit">Debit</option>
                                                <option value="credit">Credit</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">

                                        <div class="input-group">
                                            <span class="input-group-addon label-roundless" id="basic-addon1">
                                                Account:
                                            </span>

                                            <select name="on_sale_financial_account_code" class="select-search input-roundless">
                                                <option value="0">* Default</option>
                                                @foreach ($accounts as $type => $value)
                                                    <optgroup label="<?php echo $type; ?> Accounts">
                                                        @foreach ($value as $account)
                                                            @continue($account->bank_account_id)
                                                            <option value="{{$account->code}}">{{$account->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>

                                </div>
                                <!-- CLOSE: Sales information -->

                                <!-- OPEN: Cost / Purchase information -->
                                <div class="col-md-6">

                                    <div class="form-group clearfix ">
                                        <span class="label label-success">On Costing / Purchase</span>
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox checkbox-switchery switchery-xs">
                                            <label>
                                                <input type="checkbox" class="switchery" checked="checked" name="on_bill" value="bank_charge">
                                                Tax is applied to Bills - effect of tax when bills are received.
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix" title="On Costing / Purchase Effect">
                                        <div class="input-group">
                                            <span class="input-group-addon label-roundless" id="basic-addon1">
                                                Effect:
                                            </span>
                                            <select name="on_bill_effect" class="select input-roundless" data-placeholder="Select effect">
                                                <option value=""></option>
                                                <option value="debit">Debit</option>
                                                <option value="credit">Credit</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">

                                        <div class="input-group">
                                            <span class="input-group-addon label-roundless" id="basic-addon1">
                                                Account:
                                            </span>

                                            <select name="on_bill_financial_account_code" class="select-search input-roundless">
                                                <option value="0">* Default</option>
                                                @foreach ($accounts as $type => $value)
                                                    <optgroup label="<?php echo $type; ?> Accounts">
                                                        @foreach ($value as $account)
                                                            @continue($account->bank_account_id)
                                                            <option value="{{$account->code}}">{{$account->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>

                                </div>
                                <!-- CLOSE: Cost / Purchase information -->

                            </div>

                        </div>

                        <div class="form-group col-md-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" onclick="rutatiina.form_ajax_submit('#form_taxes_create');" class="btn btn-danger"><i class="icon-check"></i> Save Tax</button>
                                </div>
                            </div>
                        </div>


                    </form>

                    <div class="clearfix"></div>



                </div>

            </div>
            <!-- /pagination types -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

@endsection
