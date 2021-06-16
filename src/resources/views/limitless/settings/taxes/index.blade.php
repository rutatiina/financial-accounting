@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Items')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/item.js') }}"></script>
@endsection

@section('content')

    <!-- Second navbar -->
    <div class="navbar navbar-default navbar-lg rg_datatable_onselect_btns p-10" id="navbar-second">
        <ul class="nav navbar-nav no-border visible-xs-block">
            <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-circle-down2"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse p-10" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                <li class="active"><button type="button" class="btn btn-link rg_datatable_selected_activate text-success"><i class="icon-info22 position-left"></i> Activate</button></li>
                <li class="active"><button type="button" class="btn btn-link rg_datatable_selected_deactivate text-warning"><i class="icon-alert position-left"></i> Deactivate</button></li>
                <li class="active"><button type="button" class="btn btn-link rg_datatable_selected_delete text-danger" ><i class="icon-bin position-left"></i> Delete</button></li>
            </ul>
        </div>
    </div>
    <!-- /second navbar -->


    <!-- Page header -->
    <div class="page-header" style="border-bottom: 1px solid #ddd;">
        <div class="page-header-content">
            <div class="page-title clearfix">
                <h1 class="pull-left no-margin text-light">
                    <i class="icon-file-plus position-left"></i> Items
                    <small>Manage products, services, and cost-centers</small>
                </h1>
                <div class="pull-right">
                    <button type="button" class="btn btn-danger btn-labeled pr-20" class="label bg-blue-400" data-href="{{route('items.create')}}"><b><i class="icon-plus22"></i></b> New Item </button>

                    <div class="btn-group btn-xs btn-group-animated no-padding mr-20">
                        <button type="button" class="btn btn-danger btn-labeled pr-20 import_btn" class="label bg-blue-400"  data-import="items" data-url="{{route('items.import')}}">
                            <b><i class="icon-download4"></i></b> Import items
                        </button>
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{asset('import_templates/import_items.xlsx')}}"><i class="icon-file-download"></i> Download template</a></li>
                        </ul>
                    </div>

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
    <div class="content no-padding-left no-padding-right">

        <!-- Pagination types -->
        <div class="panel panel-flat no-border no-shadow">

            <table class="rg-datatable  table datatable-pagination no-border-top">
                <thead>
                <tr>
                    <th class="" width="12"></th>
                    <th width="16" class="text-center pl-5"><i class="icon-pencil7"></i></th>
                    <th>TYPE</th>
                    <th>NAME</th>
                    <th>SKU</th>
                    <th class="text-right">RATE</th>
                    <th class="text-right">COST</th>
                    <th>DESCRIPTION(S)</th>
                    <th>STATUS</th>
                </tr>
                </thead>
                <tbody>
                {{--
                @foreach ($items as $item)
                <tr id="row_{{$item->id}}">
                    <td>{{$item->id}}</td>
                    <td><span class="label label-default">{{str_ireplace('_', ' ', $item->type)}}</span></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->sku}}</td>
                    <td class="text-right">{{ $item->selling_rate . ' ' . $item->selling_currency}}</td>
                    <td class="text-right">{{$item->billing_rate . ' ' . $item->billing_currency}}</td>
                    <td>{{$item->selling_description}}</td>
                    <td><span class="label label-{{($item->status == 'active') ? 'success' : 'warning'}}">{{strtoupper($item->status)}}</span></td>
                    <td class="text-center">
                        <ul class="list list-inline no-margin">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle text-default" data-toggle="dropdown">
                                    <i class="icon-cog7 position-left"></i>
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="/items/update/{{$item->id}}"><i class="icon-pencil7"></i>Edit item</button></li>
                                    <li><a href="/items/deactivate/{{$item->id}}" class="rg_datatable_row_deactivate"><i class="icon-alert"></i>Deactivate item</a></li>
                                    <li><a href="/items/delete/{{$item->id}}" class="rg_datatable_row_delete"><i class="icon-bin"></i>Delete item</a></li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
                @endforeach
                --}}

                </tbody>
            </table>
        </div>
        <!-- /pagination types -->

    </div>
    <!-- /content area -->

@endsection


