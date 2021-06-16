@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Estimates')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/estimate.js') }}"></script>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Second navbar -->
        <div class="navbar navbar-default navbar-lg rg_datatable_onselect_btns p-10" id="navbar-second">
            <ul class="nav navbar-nav no-border visible-xs-block">
                <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-circle-down2"></i></a></li>
            </ul>

            <div class="navbar-collapse collapse p-10" id="navbar-second-toggle">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <button type="button" class="btn btn-link text-primary text-semibold rg_datatable_selected_export_to_excel"
                            data-href="{{route('accounting.sales.estimates.export-to-excel')}}">
                            <i class="icon-file-excel position-left"></i> Export to excel
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /second navbar -->

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #ddd;">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <h1 class="pull-left no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Estimates
                        <small>Make an offer to a customer</small>
                    </h1>
                    <div class="pull-right">
                        <a href="{{route('accounting.sales.estimates.create')}}" type="button" class="btn btn-danger pr-20"><i class="icon-plus22"></i> New Estimate </a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content no-padding">

            <!-- Pagination types -->
            <div class="panel panel-flat no-border no-shadow">

                <table class="rg-datatable-txns-table table datatable-pagination" data-ajax="{{route('accounting.sales.estimates.datatables')}}">
                    <thead>
                    <tr>
                        <th width="12"></th>
                        <th width="20"><i class="icon-menu7"></i></th>
                        <th>DATE</th>
                        <th>DOCUMENT#</th>
                        <th>REFERENCE</th>
                        <th>CONTACT NAME</th>
                        <th>STATUS</th>
                        <th>EXPIRY DATE</th>
                        <th class="text-right">TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--
                        @foreach($txns as $txn)
                        <tr>
                            <td width="12">
                                <input type="checkbox" class="dt-checkboxes">
                            </td>
                            <td width="20">
                                <i class="icon-chevron-down"></i>
                                <!--<i class="icon-chevron-up text-grey-300"></i>-->
                                <form id="txn_process_to_{{$txn->id}}" class="txn_process_to" action="/sales/process_transaction/" method="post" class="form-horizontal" style="display: none;">
                                    <input type="hidden" name="txn_id" value="{{$txn->id}}">
                                    <div class="col-lg-3" style="margin-left:45px;">
                                        <div class="input-group">
                                            <span class="input-group-addon label-roundless">Process into: </span>
                                            <select name="process_to" class="select" data-placeholder="Choose ..."  data-allow-clear="true">
                                                <option value="">Choose</option>
                                                <option value="retainer_invoice">Retainer Invoice</option>
                                                <option value="sales_order">Sales Order</option>
                                                <option value="invoice">Invoice</option>
                                                <option value="recurring_invoice">Recurring Invoice</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-danger btn-labeled input-roundless"><b><i class="icon-chevron-right"></i></b> Continue</button>
                                    </div>
                                </form>
                            </td>
                            <td>{{$txn->date}}</td>
                            <td>
                                <a href="{{route('accounting.sales.estimates.edit', $txn->id)}}">
                                    {{$txn->number}}
                                </a>
                            </td>
                            <td>{{$txn->reference}}</td>
                            <td>{{optional($txn->debit_contact)->name}}</td>
                            <td>{{$txn->status}}</td>
                            <td>{{$txn->due_date}}</td>
                            <td class="text-right">{{$txn->total}}</td>
                        </tr>
                        @endforeach
                    --}}
                    </tbody>
                </table>
            </div>
            <!-- /pagination types -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

@endsection