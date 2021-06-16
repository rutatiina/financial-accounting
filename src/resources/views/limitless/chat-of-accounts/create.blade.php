@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Account :: Create')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/chat_of_account.js') }}"></script>
@endsection

@section('content')

    <div class="navbar navbar-default navbar-fixed-top rg_datatable_onselect_btns animate-class-change">
        <button type="button" class="btn btn-link rg_datatable_selected_deactivate" data-url="/items/deactivate/"><i
                    class="icon-alert position-left"></i> Deactivate
        </button>
        <button type="button" class="btn btn-link rg_datatable_selected_activate" data-url="/items/activate/"><i
                    class="icon-info22 position-left"></i> Activate
        </button>
        <button type="button" class="btn btn-link rg_datatable_selected_delete" data-url="/items/delete/"><i
                    class="icon-bin position-left"></i> Delete
        </button>
    </div>


    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #ddd;">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <h1 class="pull-left no-margin text-light">
                        <i class="icon-file-plus position-left"></i> New Account
                        <small>New Account</small>
                    </h1>

                    <div class="pull-right">

                        <div class="btn-group btn-xs btn-group-animated no-padding mr-20">
                            <button type="button" class="btn btn-danger btn-labeled pr-20 import_btn"
                                    class="label bg-blue-400" data-import="items"><b><i class="icon-download4"></i></b>
                                Import Accounts
                            </button>
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><span
                                        class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="/import_templates/import_items.xlsx"><i class="icon-file-download"></i>
                                        Download template</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content">

            <!-- Pagination types -->
            <div class="panel panel-flat no-border no-shadow mt-20">

                <div class="panel-body">

                    <form id="item_modal_form"
                          action="{{route('accounting.accounts.index')}}"
                          method="post"
                          class="rg-item-form rg-form-ajax-submit">
                        @csrf
                        @method('POST')

                        <div class="col-md-6">

                            <fieldset>

                                <div class="form-group clearfix">
                                    <label class="col-lg-2 col-form-label">
                                        Account type:
                                    </label>
                                    <div class="col-lg-8">
                                        <select class="select-search" name="type" data-placeholder="Choose type" data-allow-clear="true">
                                            <option></option>
                                            <option value="asset|current assets">Asset (Currenct Assets)</option>
                                            <option value="asset|fixed assets">Asset (Fixed Assets)</option>
                                            <option value="equity|">Equity</option>
                                            <option value="expense|">Expense</option>
                                            <option value="income|">Income</option>
                                            <option value="liability|currenct liability">Liability (Currenct Liability)</option>
                                            <option value="liability|long term liability">Liability (Long term Liability)</option>
                                            <option value="purchase|">Purchase</option>
                                            <option value="inventory|">Inventory</option>
                                            <option value="cost_of_sales|">Cost of sales</option>
                                            <option value="none|">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-lg-2 col-form-label">
                                        Account name :
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="name" class="form-control input-roundless" placeholder="Name">
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-lg-2 col-form-label">
                                        Account code :
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="code" class="form-control input-roundless" placeholder="Code">
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-lg-2 col-form-label">
                                        Description :
                                    </label>
                                    <div class="col-lg-8">
                                        <textarea name="description" class="form-control input-roundless" rows="2" placeholder="Description"></textarea>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-md-2 col-form-label"> </label>
                                    <div class="col-lg-8">
                                        <button type="button" onclick="rutatiina.form_ajax_submit('#item_modal_form');"
                                                class="btn btn-danger"><i class="icon-check"></i> Save Account
                                        </button>
                                    </div>
                                </div>

                            </fieldset>

                        </div>

                        <div class="clearfix"></div>

                        <!--<hr class="no-margin-top" />-->

                    </form>

                </div>

            </div>
            <!-- /pagination types -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

@endsection
