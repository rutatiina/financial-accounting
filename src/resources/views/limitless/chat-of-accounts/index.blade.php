@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Accounting :: Chat Of Accounts')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/chat_of_account.js') }}"></script>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <?php /*
        <!-- Second navbar -->
        <div class="navbar navbar-default navbar-lg rg_datatable_onselect_btns p-10 hidden" id="navbar-second">
            <ul class="nav navbar-nav no-border visible-xs-block">
                <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-circle-down2"></i></a></li>
            </ul>

            <div class="navbar-collapse collapse p-10" id="navbar-second-toggle">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <button type="button" class="btn btn-link text-danger rg_datatable_selected_delete" data-url="/chat_of_accounts/delete/"><i class="icon-bin position-left"></i> Delete</button>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /second navbar -->
        */ ?>

        <div class="navbar navbar-default navbar-fixed-top rg_datatable_onselect_btns" id="navbar-second" style="margin-left: 260px;">

            <div class="navbar-collapse collapse">

                <ul class="nav navbar-nav mt-5">

                    <li>
                        <button type="button" class="btn btn-danger btn-labeled btn-xs rg_datatable_selected_delete" data-url="/chat_of_accounts/delete/"><b><i class="icon-bin"></i></b> Delete</button>
                    </li>

                </ul>

            </div>
        </div>

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #ddd;">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <h1 class="pull-left no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Chat of Account(s)
                    </h1>
                </div>
            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content no-padding-left no-padding-right">

            <!-- Pagination types -->
            <div class="panel panel-default no-border no-shadow">

                <div class="panel-heading">
                    Sort (Account Type) :
                    <div class="btn-group btn-update-text">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle text-semibold" data-toggle="dropdown" aria-expanded="true">
                            <span class="btn-text">All Accounts</span>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-left dropdown-menu-xs no-radius">
                            <li><a href="{{url()->current()}}#" class="search-accounts" data-search="" data-text="All Accounts">All Accounts</a></li>
                            <!--<li><a href="{{url()->current()}}#" class="search-accounts" data-search="" data-text="Active Accounts">Active Accounts</a></li>
                            <li><a href="{{url()->current()}}#" class="search-accounts" data-search="" data-text="Inactive Accounts">Inactive Accounts</a></li>
                            <li><a href="{{url()->current()}}#" class="search-accounts" data-search="Asset" data-text="Asset Accounts">Asset Accounts</a></li>-->
                            <li><a href="{{url()->current()}}#" class="search-accounts" data-search="Liability" data-text="Liability Accounts">Liability Accounts</a></li>
                            <li><a href="{{url()->current()}}#" class="search-accounts" data-search="Equity" data-text="Equity Accounts">Equity Accounts</a></li>
                            <li><a href="{{url()->current()}}#" class="search-accounts" data-search="Income" data-text="Income Accounts">Income Accounts</a></li>
                            <li><a href="{{url()->current()}}#" class="search-accounts" data-search="Expense" data-text="Expense Accounts">Expense Accounts</a></li>
                        </ul>
                    </div>

                    <div class="pull-right">
                        <a href="{{route('accounting.chat-of-accounts.create')}}" class="btn btn-danger pr-20"><i class="icon-plus22"></i> New Account</a>
                    </div>

                </div>

                <!--<div class="panel-body hidden">
                    Manage <code>cusotmer</code>, <code>suppliers</code>, <code>salespersons</code>, <code>retailers</code> e.t.c
                </div>-->

                <table class="rg_datatable table datatable-pagination" data-ajax="{{route('accounting.chat-of-accounts.datatables')}}">
                    <thead>
                    <tr>
                        <th class="" width="12"></th>
                        <th>NAME</th>
                        <th>CODE</th>
                        <th>TYPE</th>
                        <th>SUBTYPE</th>
                        <th>DESCRIPTION</th>
                        <th>DEBIT BALANCE</th>
                        <th>CREDIT BALANCE</th>
                        <th width="80"> </th>
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