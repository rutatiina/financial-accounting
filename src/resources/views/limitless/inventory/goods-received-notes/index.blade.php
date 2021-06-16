@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Goods Received Notes')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/goods_received_note.js') }}"></script>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Second navbar -->
        <div class="navbar navbar-default navbar-lg rg_datatable_onselect_btns" id="navbar-second">
            <ul class="nav navbar-nav no-border visible-xs-block">
                <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-circle-down2"></i></a></li>
            </ul>

            <div class="navbar-collapse collapse p-10" id="navbar-second-toggle">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <button type="button" class="btn btn-link text-primary text-semibold rg_datatable_selected_export_to_excel"
                            data-href="{{route('accounting.inventory.goods-received-notes.export-to-excel')}}">
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
                        <i class="icon-file-plus position-left"></i> Goods received(s)
                    </h1>
                    <div class="pull-right">
                        <a href="{{route('accounting.inventory.goods-received-notes.create')}}" type="button" class="btn btn-danger pr-20"><i class="icon-plus22"></i> New Goods received note </a>

                        {{--
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
                        --}}

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

                <table class="rg-datatable-txns-table table datatable-pagination" data-ajax="{{route('accounting.inventory.goods-received-notes.datatables')}}">
                    <thead>
                    <tr>
                        <th class="" width="12"></th>
                        <th>DATE</th>
                        <th>DOCUMENT#</th>
                        <th>REFERENCE</th>
                        <th>CONTACT NAME</th>
                        <th class="text-right">TOTAL</th>
                        {{--<th width="110">ACTION</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /pagination types -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->
@endsection

