@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Credit Notes')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/credit_note.js') }}"></script>
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
                    <i class="icon-file-plus position-left"></i> Credit Notes
                    <small></small>
                </h1>
                <div class="pull-right">
                    <a href="{{route('accounting.sales.credit-notes.create')}}" type="button" class="btn btn-danger pr-20"><i class="icon-plus22"></i> New Credit note </a>
                </div>
            </div>
        </div>

    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content no-padding">

        <!-- Pagination types -->
        <div class="panel panel-flat no-border no-shadow">

            <table class="rg-datatable-txns-table table datatable-pagination" data-ajax="{{route('accounting.sales.credit-notes.datatables')}}">
                <thead>
                <tr>
                    <th width="12"></th>
                    <th>Date</th>
                    <th>Document#</th>
                    <th>Reference</th>
                    <th>Contact Name</th>
                    <th class="text-right">Total</th>
                    <?php /*<th class="text-grey-300" width="110"><i class="icon-cog7"></i></th>*/ ?>
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

@endsection


