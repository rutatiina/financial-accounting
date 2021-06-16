@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Accounting :: Reports :: Balance sheet :: '.$opening_date . ' to ' . $closing_date)

@section('head')
    {{--<script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/chat_of_account.js') }}"></script>--}}
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #ddd;">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <h1 class="pull-left no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Balance sheet
                        <small>{{$opening_date . ' to ' . $closing_date}}</small>
                    </h1>

                    </div>
                </div>
            </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content">

            <!-- Pagination types -->
            <div class="panel panel-flat no-border no-shadow">

                <table class="rg-datatable table datatable-pagination no-border-top">
                    <thead>
                    <tr>
                        <th>ACCOUNT</th>
                        <th class="text-right">BALANCE ({{$currency}})</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($assets as $value)
                    <tr>
                        <td>{{$value['name']}}</td>
                        <td class="text-right">{{number_format($value['balance'], $tenant->decimal_places)}}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td class="no-border"> </td>
                        <td class="no-border"> </td>
                    </tr>

                    <tr>
                        <td class="text-bold text-uppercase">Total Assets</td>
                        <td class="text-bold text-right">{{number_format($total_assets, $tenant->decimal_places)}}</td>
                    </tr>

                    <tr>
                        <td class="no-border"> </td>
                        <td class="no-border"> </td>
                    </tr>

                    @foreach ($liability_and_equity as $value)
                    <tr>
                        <td>{{$value['name']}}</td>
                        <td class="text-right">{{number_format($value['balance'], $tenant->decimal_places)}}</td>
                    </tr>

                        @foreach ($value['sub_accounts'] as $item)
                        <tr>
                            <td class="pl-75">{{$item['name']}}</td>
                            <td class="text-right pr-50">{{number_format($item['balance'], $tenant->decimal_places)}}</td>
                        </tr>
                        @endforeach

                    @endforeach

                    <tr>
                        <td>Retained Earnings</td>
                        <td class="text-right">{{number_format($retained_earnings, $tenant->decimal_places)}}</td>
                    </tr>

                    <tr>
                        <td class="no-border"> </td>
                        <td class="no-border"> </td>
                    </tr>

                    <tr>
                        <td class="text-bold text-uppercase">Total Liability and Equity</td>
                        <td class="text-bold text-right">{{number_format($total_liability_and_equity, $tenant->decimal_places)}}</td>
                    </tr>

                    <tr>
                        <td class="no-border"> </td>
                        <td class="no-border"> </td>
                    </tr>

                    <tr>
                        <td> </td>
                        <td> </td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <!-- /pagination types -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

    <style>
    .pl-75 {
        padding-left:50px !important;
    }
    .pr-50 {
        padding-right:50px !important;
    }
    </style>
@endsection

