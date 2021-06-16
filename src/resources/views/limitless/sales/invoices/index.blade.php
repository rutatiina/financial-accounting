@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Invoices')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/invoice.js') }}"></script>
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
                    {{--
                    <li class="active">
                        <button type="button" class="btn btn-link rg_datatable_selected_deactivate" data-url="/transaction/reverse/"><i class="icon-alert position-left"></i> Reverse</button>
                    </li>
                    <li class="active">
                        <button type="button" class="btn btn-link text-danger text-semibold rg_datatable_selected_delete" data-url="/transaction/delete/"><i class="icon-bin position-left"></i> Delete</button>
                    </li>
                    --}}
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
                        <i class="icon-file-plus position-left"></i> Invoices
                        <small></small>
                    </h1>
                    <div class="pull-right">
                        <a href="{{route('accounting.sales.invoices.create')}}" type="button" class="btn btn-danger pr-20"><i class="icon-plus22"></i> New Invoice </a>

                        <?php /*
                        <div class="btn-group ml-5">
                            <button type="button" class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="icon-menu7"></i> &nbsp;<span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-right dropdown-menu-xs" style="min-width: 220px;">
                                <!--<li class="dropdown-header">SORT BY</li>
                                <li><a href="#">Created time</a></li>
                                <li><a href="#">Last modified time</a></li>
                                <li><a href="#">Date</a></li>
                                <li><a href="#">Invoice #</a></li>
                                <li><a href="#">Order Number</a></li>
                                <li><a href="#">Customer Name</a></li>
                                <li><a href="#">Due Date</a></li>
                                <li><a href="#">Amount</a></li>
                                <li><a href="#">Balance Due</a></li>
                                <li class="divider"></li>-->
                                <li><a href="#"><i class="icon-upload4"></i> Import Customer</a></li>
                                <li><a href="#"><i class="icon-upload4"></i> Import Vendors / suppliers</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="icon-download4"></i> Export Customers</a></li>
                                <li><a href="#"><i class="icon-download4"></i> Export Vendors / suppliers</a></li>
                                <li><a href="#"><i class="icon-download4"></i> Export Contacts</a></li>
                            </ul>
                        </div>
                        */ ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content no-padding">

            <!-- Pagination types -->
            <div class="panel panel-flat no-border no-shadow">

                <!--<div class="panel-body hidden">
                    Manage <code>cusotmer</code>, <code>suppliers</code>, <code>salespersons</code>, <code>retailers</code> e.t.c
                </div>-->

                <table class="rg-datatable-txns-table table datatable-pagination" data-ajax="{{route('accounting.sales.invoices.datatables')}}">
                    <thead>
                    <tr>
                        <th class="" width="12"></th>
                        <th>DATE</th>
                        <th>DOCUMENT#</th>
                        <th>REFERENCE</th>
                        <th>CONTACT NAME</th>
                        <th>STATUS</th>
                        <th>DUE DATE</th>
                        <th class="text-right">TOTAL</th>
                        <th class="text-right">BALANCE</th>
                        <?php /*<th width="110"> </th>*/ ?>
                    </tr>
                    </thead>
                    <tbody>
                    {{--
                    @foreach($txns as $txn)
                        <tr>
                            <td width="12"></td>
                            <td>{{$txn->date}}</td>
                            <td>
                                <a href="{{route('accounting.sales.invoices.edit', $txn->id)}}">
                                    {{$txn->number}}
                                </a>
                            </td>
                            <td>{{$txn->reference}}</td>
                            <td>{{optional($txn->debit_contact)->name}}</td>
                            <td>{{$txn->status}}</td>
                            <td>{{$txn->due_date}}</td>
                            <td class="text-right">{{$txn->total}}</td>
                            <td class="text-right">{{$txn->balance}}</td>
                        </tr>
                    @endforeach
                    --}}
                    </tbody>
                </table>

                {{--
                <div class="row col-md-6 col-md-push-3" style="margin-top: 30px; margin-bottom: 80px;">
                    <div class="btn-group col-md-12">
                        <div class="col-sm-5 col-md-5">
                            <a href="{{$txns->previousPageUrl()}}" class="btn btn-primary btn-rounded btn-block {{(!$txns->onFirstPage()) ? '' : 'disabled' }}">
                                <i class="icon ion-ios-arrow-back"></i> Previous
                            </a>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <span class="btn btn-link btn-block btn-rounded no-border">{{$txns->firstItem()}}-{{$txns->lastItem()}} of {{number_format($txns->total())}}</span>
                        </div>
                        <div class="col-sm-5 col-md-5">
                            <a href="{{$txns->nextPageUrl()}}" class="btn btn-primary btn-rounded btn-block {{($txns->hasMorePages()) ? '' : 'disabled' }}">
                                <i class="icon ion-ios-arrow-forward"></i> Next / More
                            </a>
                        </div>
                    </div>
                </div>
                --}}

            </div>
            <!-- /pagination types -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

@endsection
