<!-- Main content -->
<div class="content-wrapper">

    <?php /*
    <!-- Second navbar -->
    <div class="navbar navbar-default navbar-lg rg_datatable_onselect_btns p-10 hidden" id="navbar-second">
        <ul class="nav navbar-nav no-border visible-xs-block">
            <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-circle-down2"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse p-10" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                <li class="active">
                    <button type="button" class="btn btn-link text-danger rg_datatable_selected_delete" data-url="/chat_of_accounts/delete/"><i class="icon-bin position-left"></i> Delete</button>
                </li>
            </ul>
        </div>
    </div>
    <!-- /second navbar -->
    */ ?>

    <div class="navbar navbar-default navbar-fixed-top rg_datatable_onselect_btns" id="navbar-second" style="margin-left: 260px;">

        <div class="navbar-collapse collapse">

            <ul class="nav navbar-nav mt-5">

                <li>
                    <button type="button" class="btn btn-danger btn-labeled btn-xs rg_datatable_selected_delete" data-url="/chat_of_accounts/delete/"><b><i class="icon-bin"></i></b> Delete</button>
                </li>

            </ul>

        </div>
    </div>

    <!-- Page header -->
    <div class="page-header" style="border-bottom: 1px solid #ddd;">
        <div class="page-header-content">
            <div class="page-title clearfix">
                <h1 class="pull-left no-margin text-light">
                    <i class="icon-file-plus position-left"></i> Chat of Account(s)
                </h1>
            </div>
        </div>

    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content no-padding-left no-padding-right">

        <!-- Pagination types -->
        <div class="panel panel-default no-border no-shadow">

            <div class="panel-heading">
                Sort (Account Type) :
                <div class="btn-group btn-update-text">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle text-semibold" data-toggle="dropdown" aria-expanded="true">
                        <span class="btn-text">All Accounts</span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-left dropdown-menu-xs no-radius">
                        <li><a href="#" class="search-accounts" data-search="" data-text="All Accounts">All Accounts</a></li>
                        <!--<li><a href="#" class="search-accounts" data-search="" data-text="Active Accounts">Active Accounts</a></li>
                        <li><a href="#" class="search-accounts" data-search="" data-text="Inactive Accounts">Inactive Accounts</a></li>
                        <li><a href="#" class="search-accounts" data-search="Asset" data-text="Asset Accounts">Asset Accounts</a></li>-->
                        <li><a href="#" class="search-accounts" data-search="Liability" data-text="Liability Accounts">Liability Accounts</a></li>
                        <li><a href="#" class="search-accounts" data-search="Equity" data-text="Equity Accounts">Equity Accounts</a></li>
                        <li><a href="#" class="search-accounts" data-search="Income" data-text="Income Accounts">Income Accounts</a></li>
                        <li><a href="#" class="search-accounts" data-search="Expense" data-text="Expense Accounts">Expense Accounts</a></li>
                    </ul>
                </div>

                <div class="pull-right">
                    <button type="button" class="btn btn-danger pr-20" data-toggle="modal" data-target="#rg_modal_account"><i class="icon-plus22"></i> New Account</button>
                </div>

            </div>

            <!--<div class="panel-body hidden">
                Manage <code>cusotmer</code>, <code>suppliers</code>, <code>salespersons</code>, <code>retailers</code> e.t.c
            </div>-->

            <table class="rg_datatable table datatable-pagination">
                <thead>
                <tr>
                    <th class="" width="12"></th>
                    <th>NAME</th>
                    <th>CODE</th>
                    <th>TYPE</th>
                    <th>SUBTYPE</th>
                    <th>DESCRIPTION</th>
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
<!-- /main content -->




<!-- Iconified modal -->
<div id="rg_modal_account" class="modal fade">
    <div class="modal-dialog modal-md no-margin-top no-border-radius">
        <div class="modal-content">
            <div class="modal-header bg-default" style="background:#eee">
                <button type="button" class="close" data-dismiss="modal" style="color:black !important;">&times;</button>
                <h5 class="modal-title text-grey-600"><!--<i class="icon-plus3"></i>--> &nbsp;New Account</h5>
            </div>

            <div class="modal-body">

               <form id="item_modal_form" action="/financial-accounts/chat_of_accounts/" method="post" class="rg-item-form rg-form-ajax-submit">

                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    <input type="hidden" name="submit" value="1" />

                   <fieldset>

                        <div class="form-group clearfix">
                            <label class="col-lg-3 col-form-label">
                                Account type
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
                            <!--<div class="col-lg-6">Please set account type</div>-->
                        </div>

                        <div class="form-group clearfix">
                            <label class="col-lg-3 col-form-label">
                                Account name 
                            </label>
                            <div class="col-lg-8">
                                <input type="text" name="name" class="form-control input-roundless" placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <label class="col-lg-3 col-form-label">
                                Account code 
                            </label>
                            <div class="col-lg-8">
                                <input type="text" name="code" class="form-control input-roundless" placeholder="Code">
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <label class="col-lg-3 col-form-label">
                                Description 
                            </label>
                            <div class="col-lg-8">
                                <textarea name="description" class="form-control input-roundless" rows="2" placeholder="Description"></textarea>
                            </div>
                        </div>

                   </fieldset>

                   <hr class="no-margin" />            

                    <div class="m-form__actions m-form__actions--solid row hidden">
                        <div class="row col-12">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-danger  m-btn m-btn--icon">
                                    <span>
                                        <i class="fa fa-cloud-upload"></i>
                                        <span>
                                            Save details
                                        </span>
                                    </span>
                                </button>
                                <button type="reset" class="btn btn-secondary btn-sm" data-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>

                </form>


            </div>

            <div class="modal-footer text-left">
                <button type="button" onclick="chat_of_accounts.form_ajax_submit('#item_modal_form');" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /iconified modal -->
