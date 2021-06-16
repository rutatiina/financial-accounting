@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Coming soon')

@section('content')

    <style>
        .progress-micro {
            height: 5px;
        }
    </style>
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #eee;">
            <div class="page-header-content">
                <div class="page-title">
                    <h1 class="no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Coming soon
                        <small>Coming soon.</small>
                    </h1>
                </div>
            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content">

            <h4>Coming soon</h4>



            <!-- Footer -->
            <div class="footer text-muted">
                &copy; {{date('Y')}}. Maccounts - Financial, payroll and inventory accounting
            </div>
            <!-- /footer -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

@endsection


