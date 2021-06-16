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
                        <i class="icon-file-plus position-left"></i> Account statement
                        <small>Generate Account statement</small>
                    </h1>
                </div>
            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content">

            <!-- Pagination types -->
            <div class="panel panel-flat no-border no-shadow col-md-6 mt-20">

                <form id="form-account-statement-generate" action="{{url()->current()}}" method="post" class="form-horizontal" autocomplete="off">
                    @csrf
                    @method('POST')

                    <fieldset class="">

                        <div class="form-group" title="Choose Account">
                            <label class="col-lg-2 control-label">Choose Account:</label>
                            <div class="col-lg-10">
                                <select id="account-statement-financial-account-code" name="account_id" data-placeholder="Account" class="select-search">
                                    <option value=""></option>
                                    @foreach ($accountsGroupByType as $type => $accounts)
                                        <optgroup label="{{$type}}">
                                            @foreach ($accounts as $account)
                                                <option value="{{route('accounting.reports.account-statement.show', $account->code)}}">{{$account->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group" title="Choose Account">
                            <label class="col-lg-2 control-label">Choose Contact:</label>
                            <div class="col-lg-10">
                                <select id="account-statement-financial-account-code" name="contact_id" data-placeholder="Contact" class="select-search">
                                    <option value="">All contacts</option>
                                    @foreach ($contacts as $contact)
                                        <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Period</label>

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
                            <label class="col-lg-2 control-label"> </label>
                            <div class="col-lg-10">
                                <button type="submit" class="btn btn-danger"><i class="icon-check"></i> Generate Account statement</button>
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

    <style>
        @media print {
          body {
            font-size:10px;
          }
        }
    </style>
    <script>
        jQuery(document).ready(function() {
            $('#account-statement-financial-account-code').change(function () {
                $('#form-account-statement-generate').attr('action', this.value);
            });
        });
    </script>

@endsection


