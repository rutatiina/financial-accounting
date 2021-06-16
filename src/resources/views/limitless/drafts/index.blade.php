@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Accounting :: Drafts')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/drafts.js') }}"></script>
@endsection

@section('content')
    <div class="navbar navbar-default navbar-fixed-top rg_datatable_onselect_btns animate-class-change no-border-bottom" >
        <button type="button" class="btn btn-link text-danger rg_datatable_selected_delete" data-url="/transaction/delete/"><i class="icon-bin position-left"></i> Delete</button>
    </div>

    <!-- Page header -->
    <div class="page-header" style="border-bottom: 1px solid #ddd;">
        <div class="page-header-content">
            <div class="page-title clearfix">
                <h1 class="pull-left no-margin text-light">
                    <i class="icon-file-plus position-left"></i> Drafts
                    <small>Transaction drafts</small>
                </h1>
            </div>
        </div>

    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content no-padding">

        <!-- Pagination types -->
        <div class="panel panel-flat no-border no-shadow">

            <table class="rg-datatable-txns-table table datatable-pagination" data-ajax="{{route('accounting.drafts.datatables')}}">
                <thead>
                <tr>
                    <th width="12 pr-5"></th>
                    <th width="50" class=" text-center pl-0 pr-0"> </th>
                    <th>ENTRY</th>
                    <th>DOCUMENT</th>
                    <th>DATE</th>
                    <th>CONTACT NAME</th>
                    <th>REFERENCE</th>
                </tr>
                </thead>
                <tbody>
                

                </tbody>
            </table>
        </div>
        <!-- /pagination types -->

    </div>
    <!-- /content area -->
@endsection



