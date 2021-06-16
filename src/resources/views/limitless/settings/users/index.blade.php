@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Groups :: Manage')

@section('bodyClass', 'sidebar-xs sidebar-opposite-visible')

@section('sidebar_secondary')
    @include('accounting::settings.sidebar_secondary')
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #ddd;">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <div class="pull-left">
                        <h1 class="text-light">
                            Users
                        </h1>
                    </div>

                    <div class="pull-right">
                        <a href="{{route('accounting.settings.users.create')}}" type="button" class="btn btn-danger pr-20"><i class="icon-plus22"></i> New User </a>
                    </div>

                </div>
            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content no-padding">

            <div class="panel panel-flat no-border no-shadow">
                <div class="panel-body">

                    @include('limitless.basic_alerts')

                    <div class="tabbable">

                        <ul id="tabs_selected_transaction" class="nav nav-tabs nav-tabs-bottom">
                            <li class="{{(in_array(Request::input('tab'), ['groups-create', 'group-users-create'])) ? '' : 'active' }}"><a href="#tab-groups" data-toggle="tab">Users</a></li>
                            <li class="{{(Request::input('tab') == 'group-users-create') ? 'active' : '' }}"><a href="#tab-group-users-create" data-toggle="tab">In trash</a></li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane {{(in_array(Request::input('tab'), ['groups-create', 'group-users-create'])) ? '' : 'active' }}" id="tab-groups">

                                <div class="panel panel-flat no-shadow no-border-radius no-border">

                                    <div class="panel-body no-padding">


                                        <table class="rg_datatable_transactions table datatable-pagination table-hover" data-ajax="/datatable/empty/">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase">Name</th>
                                                    <th class="text-uppercase">Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($serviceUsers as $serviceUser)
                                                    <tr>
                                                        <td class="col-sm-2">{{$serviceUser->user->name}}</td>
                                                        <td>{{$serviceUser->user->email}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane {{(Request::input('tab') == 'group-users-create') ? 'active' : '' }}" id="tab-group-users-create">

                                <div class="txn_form_panel panel panel-flat no-border no-shadow">

                                    <div class="panel-body">

                                        {{-- in trach --}}

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

    <style>
        .label {
            text-transform: none !important;
            font-weight: 600;
        }
        .select2-selection--multiple .select2-selection__choice {
            background-color: transparent !important;
            color: inherit !important;
        }
    </style>

@endsection

@section('javascript')
    <script type="text/javascript">
        /* ------------------------------------------------------------------------------
        *
        *  # Styled checkboxes, radios and file input
        *
        *  Specific JS code additions for form_checkboxes_radios.html page
        *
        *  Version: 1.0
        *  Latest update: Aug 1, 2015
        *
        * ---------------------------------------------------------------------------- */

        $(function() {


            // Switchery
            // ------------------------------

            // Initialize multiple switches
            if (Array.prototype.forEach) {
                var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
                elems.forEach(function(html) {
                    var switchery = new Switchery(html);
                });
            }
            else {
                var elems = document.querySelectorAll('.switchery');
                for (var i = 0; i < elems.length; i++) {
                    var switchery = new Switchery(elems[i]);
                }
            }

            $( ".switchery-warning" ).each(function( index ) {
                new Switchery(this, { color: '#FF7043' });
                $(this).click(function () {
                    console.log('clicked: '+ $(this).data('group'));
                    $("input[value^='"+$(this).data('group')+"']").click();
                })
            });




            // Checkboxes/radios (Uniform)
            // ------------------------------

            // Default initialization
            $(".styled, .multiselect-container input").uniform({
                radioClass: 'choice'
            });

            // File input
            $(".file-styled").uniform({
                wrapperClass: 'bg-blue',
                fileButtonHtml: '<i class="icon-file-plus"></i>'
            });


            //
            // Contextual colors
            //

            // Primary
            $(".control-primary").uniform({
                radioClass: 'choice',
                wrapperClass: 'border-primary-600 text-primary-800'
            });

            // Danger
            $(".control-danger").uniform({
                radioClass: 'choice',
                wrapperClass: 'border-danger-600 text-danger-800'
            });

            // Success
            $(".control-success").uniform({
                radioClass: 'choice',
                wrapperClass: 'border-success-600 text-success-800'
            });

            // Warning
            $(".control-warning").uniform({
                radioClass: 'choice',
                wrapperClass: 'border-warning-600 text-warning-800'
            });

            // Info
            $(".control-info").uniform({
                radioClass: 'choice',
                wrapperClass: 'border-info-600 text-info-800'
            });

            // Custom color
            $(".control-custom").uniform({
                radioClass: 'choice',
                wrapperClass: 'border-indigo-600 text-indigo-800'
            });



            // Bootstrap switch
            // ------------------------------

            $(".switch").bootstrapSwitch();

        });


    </script>
@endsection
