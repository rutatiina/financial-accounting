@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Accounting :: Reports :: Trial Balance :: '.auth()->user()->tenant->name.' :: '.$openingDate.' - '.$openingDate)

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
                        <i class="icon-file-plus position-left"></i> Trial Balance
                        <small>{{$openingDate}} to {{$openingDate}}</small>
                    </h1>
                    <div class="pull-right hidden-print">
                        <a href="{{url()->previous()}}" type="button" class="btn btn-default pr-20"><i class="icon-cross"></i> Back </a>
                    </div>
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
                        <th class="text-right">DEBIT ({{$currency}})</th>
                        <th class="text-right">CREDIT ({{$currency}})</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($accounts as $account)
                    <tr class="{{(empty($account->total_debit) && empty($account->total_credit)) ? 'hidden' : ''}}" title="{{$account->name}}">
                        <td>{{$account->name}}</td>
                        <td class="text-right">{{number_format($account->total_debit, $tenant->decimal_places)}}</td>
                        <td class="text-right">{{number_format($account->total_credit, $tenant->decimal_places)}}</td>
                    </tr>
                    @endforeach

                    <tr class="{{($totalDebit == $totalCredit)? 'bg-success' : 'bg-danger'}}" title="{{($balancingFigure)? 'Balancing figure: '.number_format($balancingFigure, $tenant->decimal_places) : 'Balances'}}">
                        <td class="no-border"><strong>Total</strong></td>
                        <td class="text-right no-border"><strong>{{number_format($totalDebit, $tenant->decimal_places)}}</strong></td>
                        <td class="text-right no-border"><strong>{{number_format($totalCredit, $tenant->decimal_places)}}</strong></td>
                    </tr>

                    @if($balancingFigure)
                    <tr class="bg-warning">
                        <td>Balancing amount</td>
                        <td class="text-right text-bold">{{($totalDebit<$totalCredit) ? number_format($balancingFigure, $tenant->decimal_places) : '-'}}</td>
                        <td class="text-right text-bold">{{($totalCredit<$totalDebit) ? number_format($balancingFigure, $tenant->decimal_places) : '-'}}</td>
                    </tr>
                    @endif

                    <tr>
                        <td> </td>
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

