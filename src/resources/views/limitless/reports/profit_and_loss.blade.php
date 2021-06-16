@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Accounting :: Reports :: Profit and Loss Statement :: '.$opening_date . ' to ' . $closing_date)

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
                        <i class="icon-file-plus position-left"></i> Profit and Loss Statement
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

                <table class="rg-datatable table table-hover datatable-pagination no-border-top">
                    <thead>
                    <tr>
                        <th>ACCOUNT</th>
                        <th class="text-right">BALANCE ({{$currency}})</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($incomes as $value)
                    <tr>
                        <td>{{$value->name}}</td>
                        <td class="text-right">{{number_format($value->balance_total, $tenant->decimal_places)}}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td>Total Income</td>
                        <td class="text-right">{{number_format($total_income, $tenant->decimal_places)}}</td>
                    </tr>

                    @foreach ($cost_of_sales as $value)
                    <tr>
                        <td>{{$value->name}}</td>
                        <td class="text-right">{{number_format($value->balance_total, $tenant->decimal_places)}}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td class="text-bold text-uppercase">Gross {{($gross_profit_or_loss < 0 ) ? 'Loss' : 'Profit'}}</td>
                        <td class="text-bold text-right">{{number_format($gross_profit_or_loss, $tenant->decimal_places)}}</td>
                    </tr>

                    <tr>
                        <td class="no-border"> </td>
                        <td class="no-border"> </td>
                    </tr>


                    @foreach ($expenses as $value)
                    <tr>
                        <td>{{$value->name}}</td>
                        <td class="text-right">{{number_format($value->balance_total, $tenant->decimal_places)}}</td>
                    </tr>

                        @foreach ($value->sub_accounts as $item)
                        <tr>
                            <td class="pl-75">{{$item->name}}</td>
                            <td class="text-right pr-50">{{number_format($item->balance_total, $tenant->decimal_places)}}</td>
                        </tr>
                        @endforeach

                    @endforeach

                    <tr>
                        <td>Total Expense</td>
                        <td class="text-right">{{number_format($total_expense, $tenant->decimal_places)}}</td>
                    </tr>

                    <tr>
                        <td class="no-border"> </td>
                        <td class="no-border"> </td>
                    </tr>


                    <tr>
                        <td class="text-bold text-uppercase">Net {{($net_profit_or_loss < 0 ) ? 'Loss' : 'Profit'}}</td>
                        <td class="text-bold text-right">{{number_format($net_profit_or_loss, $tenant->decimal_places)}}</td>
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

