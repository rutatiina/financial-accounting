@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Accounting :: Settings :: Transaction types')

@section('bodyClass', 'sidebar-xs sidebar-opposite-visible')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/txn_type.js') }}"></script>
@endsection

@section('sidebar_secondary')
    @include('accounting::settings.sidebar_secondary')
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <h1 class="no-margin text-light pull-left">
                        <i class="icon-file-plus position-left"></i> Transaction Type
                        <small>Create Transaction type or document.</small>
                    </h1>
                </div>
            </div>

        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content no-border no-padding">

            <div class=" p-20">
                @include('limitless.basic_alerts')
            </div>

            <!-- Form horizontal -->
            <div id="txn_type_form_panel" class="panel panel-flat no-border no-shadow no-padding">

                <div class="panel-body">

                    <form id="txn_type_form" action="{{route('accounting.settings/txn-type', $type->id)}}" method="post" class="form-horizontal">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="submit" value="1" />
                        <input type="hidden" name="id" value="{{$type->id}}" />

                        <fieldset class="max-width-1040">
                            <div class="form-group">
                                <div class="">
                                    <label class="col-lg-2 control-label">
                                        Name:
                                    </label>
                                    <div class="col-lg-5">
                                        <input type="text" name="name" value="{{$type->name}}" class="form-control input-roundless" placeholder="Name">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-sm-2">
                                    Show payment details:
                                </label>
                                <div class="col-sm-5">
                                    <select name="show_payment_instructions" class="bootstrap-select input-roundless" data-multiple-separator=", "  data-width="100%">
                                        <option value="0" {{( $type->show_payment_instructions == '0' ) ? 'selected':''}}>No</option>
                                        <option value="1" {{( $type->show_payment_instructions == '1' ) ? 'selected':''}}>Yes</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">

                                <label class="col-lg-2 control-label">
                                    Show terms:
                                </label>
                                <div class="col-lg-5">
                                    <select name="show_terms_and_conditions" class="bootstrap-select input-roundless" data-multiple-separator=", "  data-width="100%">
                                        <option value="0"  {{( $type->show_terms_and_conditions == '0' ) ? 'selected':''}}>No</option>
                                        <option value="1"  {{( $type->show_terms_and_conditions == '1' ) ? 'selected':''}}>Yes</option>
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="col-lg-2 control-label"> </label>
                                <div class="col-lg-10">
                                    <button type="button" onclick="rutatiina.form_ajax_submit('#txn_type_form', false);" class="btn btn-danger"><i class="icon-check"></i> Update transaction type</button>
                                </div>

                            </div>



                        </fieldset>



                    </form>
                </div>
            </div>
            <!-- /form horizontal -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->
@endsection

