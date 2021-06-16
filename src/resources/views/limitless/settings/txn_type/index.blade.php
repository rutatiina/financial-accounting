@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Accounting :: Settings :: Transaction types')

@section('bodyClass', 'sidebar-xs sidebar-opposite-visible')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/txn_type.js') }}"></script>
@endsection

@section('sidebar_secondary')
    @include('accounting::settings.sidebar_secondary')
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <h1 class="no-margin text-light pull-left">
                        <i class="icon-file-plus position-left"></i> Transaction Type
                        <small>Manage Transaction type or document.</small>
                    </h1>
                    <div class="pull-right">
                        <a href="{{route('accounting.settings.txn-types.create')}}" type="button" class="btn btn-danger pr-20"><i class="icon-plus22"></i> New Transaction type </a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content no-border no-padding">

            <div class=" p-20">
                @include('limitless.basic_alerts')
            </div>


            <!-- Basic datatable -->
            <div class="panel panel-flat no-border no-shadow no-border-radius p-20">
                <!--<div class="panel-heading">
                    <h5 class="panel-title">Transaction entrees</h5>
                </div>-->

                <div class="rg_datatable_onselect_btns1 animate-class-change" style="display: none;">
                    <button type="button" class="btn btn-link text-danger text-semibold rg_datatable_selected_delete" data-url="/delete/txn_type/"><i class="icon-bin position-left"></i> Delete selected rows</button>
                    <hr class="mt-10">
                </div>

                <table class="rg-datatable table datatable-pagination" data-ajax="{{route('accounting.settings.txn-types.datatables')}}">
                    <thead>
                    <tr>
                        <th class="" width="12"></th>
                        <th>NAME</th>
                        <th>CATEGORY</th>
                        <th>SHOW PAYMENT</th>
                        <th>SHOW TERMS</th>
                        <th width="110"> </th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <div class="rg_datatable_onselect_btns1 animate-class-change" style="display: none;">
                    <hr class="mt-10">
                    <button type="button" class="btn btn-link text-danger text-semibold rg_datatable_selected_delete" data-url="/delete/txn_type/"><i class="icon-bin position-left"></i> Delete selected rows</button>
                </div>

            </div>
            <!-- /basic datatable -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->
@endsection

