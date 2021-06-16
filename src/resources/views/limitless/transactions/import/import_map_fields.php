<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header" style="border-bottom: 1px solid #ddd;">
        <div class="page-header-content">
            <div class="page-title clearfix">
                <h1 class="pull-left no-margin text-light">
                    Import Transactions
                    <small>Map import fields</small>
                </h1>
                
            </div>
        </div>

    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

        <?php echo Template::message(); ?>

        <div class="row mt-20">
            <div class="col-md-6">
                <div class="panel panel-flat no-border no-shadow ">

                    <div class="panel-body">

                        <p>File name: <code><?php echo $import['file_name']; ?></code></p>
                        <p>The auto seleted matches by the system are;</p>

                        <form action="/financial-accounts/transactions/import/que" method="post" class="form-horizontal mt-20">

                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            <input type="hidden" name="submit" value="1" />
                            <input type="hidden" name="id" value="<?php echo $import['id']; ?>" />

                            <fieldset class="">

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Process as:</label>
                                    <div class="col-lg-4">
                                        <select id="transaction_rule_deposit_process_as_field" name="txn_entree" class="select" data-placeholder="Process Transaction as" data-allow-clear="true">
                                            <option value=""></option>
                                            <optgroup label="Sales">
                                                <option value="estimate">Estimate</option>
                                                <option value="sales_order">Sales Order</option>
                                                <option value="invoice">Invoice</option>
                                                <option value="invoice_receipt">Receipt</option>
                                                <option value="credit_note">Credit note</option>
                                            </optgroup>

                                            <optgroup label="Purchase">
                                                <option value="expense">Expense</option>
                                                <option value="purchase_order">Purchase Order</option>
                                                <option value="bill">Bill</option>
                                                <option value="payment">Payment</option>
                                                <option value="debit_note">Debit Note</option>
                                            </optgroup>

                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <div class="col-lg-3 text-muted">System fields:</div>
                                    <div class="col-lg-4 text-muted">Imported field headers</div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">External Id:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[external_id]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'A') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Number:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[number]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'B') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Customer or Supplier:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[contact]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'C') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Base currency:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[base_currency]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'D') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Quote currency:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[quote_currency]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'E') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Exchange rate:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[exchange_rate]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'F') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Date:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[date]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'G') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <select name="format[date_format]" class="select input-roundless" >
                                            <option value="yyyy/MM/dd">yyyy/MM/dd</option>
                                            <option value="dd.MM.yy">dd.MM.yy</option>
                                            <option value="MM/dd/yyyy">MM/dd/yyyy</option>
                                            <option value="dd.MM.yyyy">dd.MM.yyyy</option>
                                            <option value="MM.dd.yy">MM.dd.yy</option>
                                            <option value="MM-dd-yyyy">MM-dd-yyyy</option>
                                            <option value="yyyy.MM.dd">yyyy.MM.dd</option>
                                            <option value="dd/MM/yyyy" selected>dd/MM/yyyy</option>
                                            <option value="MM.dd.yyyy">MM.dd.yyyy</option>
                                            <option value="dd-MM-yyyy">dd-MM-yyyy</option>
                                            <option value="dd/MM/yy">dd/MM/yy</option>
                                            <option value="yyyy-MM-dd">yyyy-MM-dd</option>
                                            <option value="MM/dd/yy">MM/dd/yy</option>
                                            <option value="yy.MM.dd">yy.MM.dd</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Due Date:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[due_date]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'H') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <select name="format[due_date_format]" class="select input-roundless" >
                                            <option value="yyyy/MM/dd">yyyy/MM/dd</option>
                                            <option value="dd.MM.yy">dd.MM.yy</option>
                                            <option value="MM/dd/yyyy">MM/dd/yyyy</option>
                                            <option value="dd.MM.yyyy">dd.MM.yyyy</option>
                                            <option value="MM.dd.yy">MM.dd.yy</option>
                                            <option value="MM-dd-yyyy">MM-dd-yyyy</option>
                                            <option value="yyyy.MM.dd">yyyy.MM.dd</option>
                                            <option value="dd/MM/yyyy" selected>dd/MM/yyyy</option>
                                            <option value="MM.dd.yyyy">MM.dd.yyyy</option>
                                            <option value="dd-MM-yyyy">dd-MM-yyyy</option>
                                            <option value="dd/MM/yy">dd/MM/yy</option>
                                            <option value="yyyy-MM-dd">yyyy-MM-dd</option>
                                            <option value="MM/dd/yy">MM/dd/yy</option>
                                            <option value="yy.MM.dd">yy.MM.dd</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Expiry Date:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[expiry_date]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'I') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <select name="format[expirty_date_format]" class="select input-roundless" >
                                            <option value="yyyy/MM/dd">yyyy/MM/dd</option>
                                            <option value="dd.MM.yy">dd.MM.yy</option>
                                            <option value="MM/dd/yyyy">MM/dd/yyyy</option>
                                            <option value="dd.MM.yyyy">dd.MM.yyyy</option>
                                            <option value="MM.dd.yy">MM.dd.yy</option>
                                            <option value="MM-dd-yyyy">MM-dd-yyyy</option>
                                            <option value="yyyy.MM.dd">yyyy.MM.dd</option>
                                            <option value="dd/MM/yyyy" selected>dd/MM/yyyy</option>
                                            <option value="MM.dd.yyyy">MM.dd.yyyy</option>
                                            <option value="dd-MM-yyyy">dd-MM-yyyy</option>
                                            <option value="dd/MM/yy">dd/MM/yy</option>
                                            <option value="yyyy-MM-dd">yyyy-MM-dd</option>
                                            <option value="MM/dd/yy">MM/dd/yy</option>
                                            <option value="yy.MM.dd">yy.MM.dd</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Reference:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[reference]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'J') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Expense Account:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[expense_account]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'K') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3"> </label>
                                    <div class="col-lg-9 checkbox">
                                        <label>
                                            <input name="item_on_row" value="yes" type="checkbox" class="ml-10">
                                            Each Item is on a separate row
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Item Name:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[item_name]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'L') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Item Description:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[item_description]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'M') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Item Quantity:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[item_quantity]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'N') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <select name="format[item_quantity_format]" class="select input-roundless" >
                                            <option value="1234567.89">1234567.89</option>
                                            <option value="1,234,567.89">1,234,567.89</option>
                                            <option value="1 234 567.89">1 234 567.89</option>
                                            <option value="1234567,89">1234567,89</option>
                                            <option value="1.234.567,89">1.234.567,89</option>
                                            <option value="1 234 567,89">1 234 567,89</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Item Rate:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[item_rate]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'O') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <select name="format[item_rate_format]" class="select input-roundless" >
                                            <option value="1234567.89">1234567.89</option>
                                            <option value="1,234,567.89">1,234,567.89</option>
                                            <option value="1 234 567.89">1 234 567.89</option>
                                            <option value="1234567,89">1234567,89</option>
                                            <option value="1.234.567,89">1.234.567,89</option>
                                            <option value="1 234 567,89">1 234 567,89</option>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Terms Of Payment:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[terms_of_payment]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'P') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Payment Mode:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[payment_mode]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'Q') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Contact Notes:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[contact_notes]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'R') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Terms and Conditions:</label>
                                    <div class="col-lg-4">
                                        <select name="mapping[terms_and_conditions]" class="select input-roundless" >
                                            <?php foreach ($import['file_columns'] as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($key == 'S') ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-lg-3">
                                        <a href="/financial-accounts/transactions/import/" class="btn btn-default"> Previous </a>
                                    </label>
                                    <div class="col-lg-7">
                                        <button type="submit" class="btn btn-success btn-labeled"><b><i class="icon-chevron-right"></i></b> Add Transactions to Import Que</button>
                                        <a href="/financial-accounts/transactions/import/" class="btn btn-default ml-10"> Cancel </a>
                                    </div>
                                </div>

                            </fieldset>


                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /content area -->

</div>
<!-- /main content -->


