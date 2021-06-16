@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Accounting :: Settings :: Transaction Entree :: Create')

@section('bodyClass', 'sidebar-xs sidebar-opposite-visible')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/txn_entree.js') }}"></script>
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
                        <i class="icon-file-plus position-left"></i> Transaction Entree
                        <small>Create Transaction Entrees.</small>
                    </h1>
                </div>
            </div>

        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content no-border no-padding" >

            <div class=" p-20">
                @include('limitless.basic_alerts')
            </div>

            <!-- Form horizontal -->
            <div id="txn_entree_form_panel" class="panel panel-flat no-border no-shadow no-border-radius">

                <div class="panel-body">

                    <form id="txn_entree_form" action="{{route('accounting.settings.txn-entrees.store')}}" method="post" class="form-horizontal">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="submit" value="1" />

                        <fieldset class="max-width-1040">
                            <div class="form-group">
                                <div class="">
                                    <label class="col-lg-2 control-label">Name *</label>
                                    <div class="col-lg-5">
                                        <input type="text" name="name" value="" class="form-control input-roundless" placeholder="Name">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-sm-2">
                                    Valuation:
                                </label>
                                <div class="col-sm-5">
                                    <select name="valuation" class="bootstrap-select input-roundless" data-multiple-separator=", "  data-width="100%">
                                        <option value="sales">Sales</option>
                                        <option value="cost">Cost</option>
                                        <option value="quantity">Quantity</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">

                                <label class="col-lg-2 control-label">
                                    Fields:
                                </label>
                                <div class="col-lg-10">
                                    <select name="fields[]" class="bootstrap-select input-roundless" multiple data-multiple-separator=", "  data-width="100%">
                                        <option value="reference">Reference</option>
                                        <option value="due_date">Due date</option>

                                        {{--
                                        <option value="item_discount" <?php if ( preg_match('/item_discount/i', @$contact->category)) { echo 'selected'; } ?>>Supplier</option>
                                        <option value="item_tax" <?php if ( preg_match('/item_tax/i', @$contact->category)) { echo 'selected'; } ?>>Salesperson</option>
                                        --}}
                                    </select>
                                </div>

                            </div>


                            <div class="form-group">

                                <label class="col-lg-2 control-label">Configuration * </label>
                                <div class="col-lg-10">

                                    <table id="txn_entrees" class="table table-bordered no-border-left no-border-right no-border-bottom">
                                        <thead class="thead-default">
                                        <tr>
                                            <th class="pl-15 col-lg-4">Transaction type</th>
                                            <th class="pl-15 col-lg-4">Debit</th>
                                            <th class="pl-15 col-lg-4">Credit</th>
                                        </tr>
                                        </thead>
                                        <tbody id="txn_entree_field_rows">

                                            <tr class="txn_entree_row_template hidden">
                                                <td class="no-padding no-border">
                                                    <select class="" name="config[_index_][txn_type_id]">
                                                        @foreach($txn_types as $index => $txn_type)
                                                        <option value="{{$txn_type->id}}">{{$txn_type->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="no-padding no-border">
                                                    <select class="" name="config[_index_][debit]">
                                                        <option value="">None</option>
                                                        @foreach($accounts as $index => $account) { ?>
                                                        <option value="{{$account->code}}">{{$account->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="no-padding no-border">
                                                    <select class="" name="config[_index_][credit]">
                                                        <option value="">None</option>
                                                        @foreach($accounts as $index => $account)
                                                        <option value="{{$account->code}}">{{$account->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <button type="button" onclick="txn_entree.config(true);" class="btn btn-link btn-xs text-bold"><i class="icon-plus22 position-left"></i>Add a row</button>

                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-lg-2 control-label"> </label>
                                <div class="col-lg-10">
                                    <button type="button" onclick="rutatiina.form_ajax_submit('#txn_entree_form');" class="btn btn-danger"><i class="icon-check"></i> Save transaction entree</button>
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


