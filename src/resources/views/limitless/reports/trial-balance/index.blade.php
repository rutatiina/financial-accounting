@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Account statement :: Generate')

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #ddd;">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <h1 class="pull-left no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Trial Balance
                        <small>Generate Trial Balance</small>
                    </h1>
                </div>
            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content">

            <!-- Pagination types -->
            <div class="panel panel-flat no-border no-shadow col-md-6 mt-20">

                <form action="{{route('accounting.reports.trial-balance.show')}}" method="post" class="form-horizontal" autocomplete="off">
                    @csrf
                    @method('POST')

                    <fieldset class="">

                        <div class="form-group">

                            <div class="col-lg-5">
                                <div class="input-group">
                                    <span class="input-group-addon label-roundless">Opening date:</span>
                                    <input type="text" name="opening_date" value="{{date('Y-m-d', strtotime('-1 years'))}}" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <span class="input-group-addon label-roundless">Closing date:</span>
                                    <input type="text" name="closing_date" value="{{date('Y-m-d')}}" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-10">
                                <button type="submit" class="btn btn-danger"><i class="icon-check"></i> Generate Trial Balance</button>
                            </div>
                        </div>

                    </fieldset>

                </form>

            </div>
            <!-- /pagination types -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->


@endsection


