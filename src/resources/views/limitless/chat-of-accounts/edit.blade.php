@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Account :: Create')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/chat_of_account.js') }}"></script>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #ddd;">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <h1 class="pull-left no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Edit Account
                        <small>Edit Account</small>
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
                          action="{{route('accounting.chat-of-accounts', $account->code)}}"
                          method="post"
                          class="rg-item-form rg-form-ajax-submit">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="code" value="{{$account->code}}">

                        <div class="col-md-6">

                            <fieldset>

                                <div class="form-group clearfix">
                                    <label class="col-lg-2 col-form-label">
                                        Account type:
                                    </label>
                                    <div class="col-lg-8">
                                        <select class="select-search" name="type" data-placeholder="Choose type" data-allow-clear="true">
                                            <option></option>
                                            <option value="asset|current assets" {{$account->_type_info_ == 'asset|current assets' ? 'selected' : ''}}>Asset (Currenct Assets)</option>
                                            <option value="asset|fixed assets" {{$account->_type_info_ == 'asset|fixed assets' ? 'selected' : ''}}>Asset (Fixed Assets)</option>
                                            <option value="equity|" {{$account->_type_info_ == 'equity|' ? 'selected' : ''}}>Equity</option>
                                            <option value="expense|" {{$account->_type_info_ == 'expense|' ? 'selected' : ''}}>Expense</option>
                                            <option value="income|" {{$account->_type_info_ == 'income|' ? 'selected' : ''}}>Income</option>
                                            <option value="liability|current liability" {{$account->_type_info_ == 'liability|current liability' ? 'selected' : ''}}>Liability (Currenct Liability)</option>
                                            <option value="liability|long term liability" {{$account->_type_info_ == 'liability|long term liability' ? 'selected' : ''}}>Liability (Long term Liability)</option>
                                            <option value="purchase|" {{$account->_type_info_ == 'purchase|' ? 'selected' : ''}}>Purchase</option>
                                            <option value="inventory|" {{$account->_type_info_ == 'inventory|' ? 'selected' : ''}}>Inventory</option>
                                            <option value="cost_of_sales|" {{$account->_type_info_ == 'cost_of_sales|' ? 'selected' : ''}}>Cost of sales</option>
                                            <option value="none|" {{$account->_type_info_ == 'none|' ? 'selected' : ''}}>None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-lg-2 col-form-label">
                                        Account name :
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="name" value="{{$account->name}}" class="form-control input-roundless" placeholder="Name">
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-lg-2 col-form-label">
                                        Account code :
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="code" value="{{$account->code}}" class="form-control input-roundless" placeholder="Code">
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-lg-2 col-form-label">
                                        Description :
                                    </label>
                                    <div class="col-lg-8">
                                        <textarea name="description" class="form-control input-roundless" rows="2" placeholder="Description">{{$account->description}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-md-2 col-form-label"> </label>
                                    <div class="col-lg-8">
                                        <button type="button" onclick="rutatiina.form_ajax_submit('#item_modal_form');"
                                                class="btn btn-danger"><i class="icon-check"></i> Update Account
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