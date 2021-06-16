@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Accounting :: Journals')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/journal.js') }}"></script>
@endsection

@section('content')
        <div class="navbar navbar-default navbar-fixed-top rg_datatable_onselect_btns animate-class-change" >
            <!--<button type="button" class="btn btn-link rg_datatable_selected_deactivate" data-url="/transaction/reverse/"><i class="icon-alert position-left"></i> Reverse</button>-->
            <button type="button" class="btn btn-link text-danger rg_datatable_selected_delete" data-url="/transaction/delete/"><i class="icon-bin position-left"></i> Delete</button>
        </div>

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #ddd;">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <h1 class="pull-left no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Journals
                    </h1>
                    <div class="pull-right">
                        <a href="{{route('accounting.journals.create')}}" type="button" class="btn btn-danger pr-20"><i class="icon-plus22"></i> New Journal </a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content no-padding">

            <!-- Pagination types -->
            <div class="panel panel-flat no-border no-shadow">

                <table class="rg-datatable-txns-table table datatable-pagination" data-ajax="{{route('accounting.journals.datatables')}}">
                    <thead>
                    <tr>
                        <th width="12"></th>
                        <th width="12" class="text-left no-padding-left"> </th>
                        <th>DATE</th>
                        <th>REFERENCE</th>
                        <th class="text-right">AMOUNT</th>
                        <th class="text-left">ATTACHMENTS</th>
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



