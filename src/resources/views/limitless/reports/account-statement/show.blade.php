@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Account statement :: '.$account->name.' :: '.$opening_date.' - '.$closing_date)

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
                        <i class="icon-file-plus position-left"></i> {{$account->name}}
                        <small>
                            Account statement from <span class="text-bold">{{$opening_date}}</span> to <span class="text-bold">{{$closing_date}}</span>
                        </small>
                    </h1>
                    <div class="pull-right hidden-print">
                        <a href="{{url()->previous()}}" type="button" class="btn btn-default pr-20"><i class="icon-cross"></i> Back </a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content no-padding">

            <!-- Pagination types -->
            <div class="panel panel-flat no-border no-shadow">

                <table class="rg-datatable table table-hover datatable-pagination">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Contact Name</th>
                            <th>Name</th>
                            <th>Invoice No</th>
                            <th>Reference</th>
                            <th>Number</th>
                            <th class="text-right">Debit Amount</th>
                            <th class="text-right">Credit Amount</th>
                            <th class="text-right">Running Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($txns as $txn)
                        <tr>
                            <td>{{$txn->date}}</td>
                            <td>{{optional($txn)->contact_name}}</td>
                            <td>
                                @if ($txn->name)
                                    {{$txn->name}}
                                @else
                                    {{optional($txn->type)->name}}
                                @endif
                            </td>
                            <td>{{optional($txn)->invoice_number}}</td>
                            <td>{{optional($txn)->reference}}</td>
                            <td>{{optional($txn)->number}}</td>
                            <td class="text-right">
                                @if(optional($txn)->debit_amount)
                                {{number_format(optional($txn)->debit_amount, $tenant->decimal_places) }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(optional($txn)->credit_amount)
                                {{number_format(optional($txn)->credit_amount, $tenant->decimal_places)}}
                                @endif
                            </td>
                            <td class="text-right">
                                {{number_format(optional($txn)->running_balance, $tenant->decimal_places)}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /pagination types -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

    <style>
        @media print {
          body {
            font-size:10px;
          }
        }
    </style>

@endsection


