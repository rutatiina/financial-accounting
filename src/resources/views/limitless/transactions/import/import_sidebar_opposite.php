
    <!-- Opposite sidebar -->
    <div class="sidebar sidebar-opposite sidebar-default" style="width:650px;border-left: 1px solid #ddd;">
        <div class="sidebar-content">

            <div class="panel panel-flat no-border no-shadow">
                <div class="panel-body">
                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="active"><a href="#bottom-tab1" data-toggle="tab" style="background: none;">Add Transaction(s) To Import Que</a></li>
                            <li class=""><a href="#bottom-tab2" data-toggle="tab" style="background: none;">Import Rules</a></li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane active" id="bottom-tab1">

                                <div class="panel panel-flat no-border no-shadow">

                                    <?php echo Template::message(); ?>

                                    <div class="panel-body">

                                        <p>Download a <a href="/import_templates/import_transactions.xlsx">sample file</a> for the import.</p>

                                        <hr>

                                        <form action="/financial-accounts/transactions/import/map_fields" method="post" enctype="multipart/form-data" class="form-horizontal">

                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                            <input type="hidden" name="submit" value="1" />

                                            <input type="file" name="file" value="" class="hidden" id="file_to_import" />

                                            <fieldset class="content-group">

                                                <div class="form-group">
                                                    <label class="control-label col-md-12">Choose upload file</label>
                                                    <div class="col-md-12">
                                                        <div class="btn-group pull-left">
                                                            <button type="button" class="btn bg-danger btn-labeled dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><b><i class="icon-reading"></i></b> Choose file <span class="caret"></span></button>
                                                            <ul class="dropdown-menu dropdown-menu-left">
                                                                <li><a href="#" class="import_from_desktop"> Choose file from desktop</a></li>
                                                                <?php /*<li><a href="#"><i class="icon-screen-full"></i> Choose file from documents</a></li>*/ ?>
                                                            </ul>
                                                        </div>
                                                        <div class="pull-left pt-10 pl-20" id="file_to_import_name"> No file selected</div>
                                                        <div class="clearfix"></div>
                                                        <div class="text-muted pt-10"><small>File format: CSV or TSV or OFX or QIF or CAMT.053</small></div>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-12">Character Encoding</label>
                                                    <div class="col-md-6">
                                                        <select name="encoding" class="select-search input-roundless">
                                                            <option value="UTF-8 (Unicode)">UTF-8 (Unicode)</option>
                                                            <?php /*
                                    <option value="UTF-16 (Unicode)">UTF-16 (Unicode)</option>
                                    <option value="ISO-8859-1">ISO-8859-1</option>
                                    <option value="ISO-8859-2">ISO-8859-2</option>
                                    <option value="ISO-8859-9">ISO-8859-9 (Turkish)</option>
                                    <option value="GB2312">GB2312 (Simplified Chinese)</option>
                                    <option value="Big5">Big5 (Traditional Chinese)</option>
                                    <option value="Shift_JIS">Shift_JIS (Japanese)</option>
                                    */ ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="form-group">
                                                    <!--<label class="control-label col-lg-3"> </label>-->
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-success btn-labeled"><b><i class="icon-chevron-right"></i></b> Continue</button>
                                                    </div>
                                                </div>

                                            </fieldset>


                                        </form>

                                    </div>


                                </div>

                                <div class="panel panel-flat no-border no-shadow">

                                    <div class="panel-body">

                                        <div class="import-help">
                                            <h5 class="pl-20">Tip / Help</h5>
                                            <ul>
                                                <li>If you have files in other formats, please convert it to an accepted file format.</li>
                                                <li>You can configure your import settings and save them for future too!</li>
                                            </ul>
                                        </div>

                                    </div>


                                </div>

                            </div>

                            <div class="tab-pane " id="bottom-tab2">

                                <div class="panel panel-flat no-border no-shadow">

                                    <?php echo Template::message(); ?>

                                    <div class="panel-body no-padding">

                                        <form id="transaction_import_rule_form" action="/financial-accounts/transactions/import/rules" method="post">

                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                            <input type="hidden" name="submit" value="1" />

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label>Rule name</label>
                                                        <input type="text" name="name" placeholder="Rule Name" class="form-control input-roundless">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="">Categorize the transaction when</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="categorize_when" value="all" checked="checked">
                                                        All of the following criteria matches
                                                    </label>
                                                </div>

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="categorize_when" value="any">
                                                        Any one of the following criteria matches
                                                    </label>
                                                </div>
                                            </div>

                                            <div id="transaction_rule_criteria_fields" class="form-group transaction_rule_criteria_fields hidden">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <select name="criteria[_][column]" data-placeholder="Column" class="">
                                                            <option value=""></option>
                                                            <option value="contact">Contact</option>
                                                            <option value="base_currency">Base currency</option>
                                                            <option value="quote_currency">Quote currency</option>
                                                            <option value="date">Date</option>
                                                            <option value="due_date">Due Date</option>
                                                            <option value="expiry_date">Expiry Date</option>
                                                            <option value="reference">Reference</option>
                                                            <option value="expense_account">Expense Account</option>
                                                            <option value="item_name">Item Name</option>
                                                            <option value="item_description">Item Description</option>
                                                            <option value="item_quantity">Item Quantity</option>
                                                            <option value="item_rate">Item Rate</option>
                                                            <option value="terms_of_payment">Terms Of Payment</option>
                                                            <option value="payment_mode">Payment Mode</option>
                                                            <option value="contact_notes">Contact Notes</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <select name="criteria[_][condition]" data-placeholder="Condition" class="">
                                                            <option value=""></option>
                                                            <option value="is">is</option>
                                                            <option value="contains">contains</option>
                                                            <option value="starts_with">starts with</option>
                                                            <option value="is_empty">is empty</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-5">
                                                        <input type="text" name="criteria[_][value]" value="" placeholder="Value" class="form-control input-roundless">
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="transaction_rule_criteria_add" class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <a href="#"><i class="icon-plus22"></i> Add another Criteria</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label>Process Transaction as</label>
                                                        <select id="transaction_rule_deposit_process_as_field" name="txn_entree_id" class="select" data-placeholder="Process Transaction as" data-allow-clear="true">
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

                                                            <optgroup label="Others">
                                                                <option value="journal">Journal Entry</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Fields -->
                                            <div id="journal_fields" class="form-group _options hidden">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label>Account to Debit</label>
                                                        <select name="options[journal_entry][debit]" data-placeholder="Account to Debit" class="select-search">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mt-20">
                                                    <div class="col-sm-12">
                                                        <label>Account to Credit</label>
                                                        <select name="options[journal_entry][credit]" data-placeholder="Account to Credit" class="select-search">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end #journal_entry_fields -->

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <button type="button" class="btn btn-danger" onclick="rutatiina.form_ajax_submit('#transaction_import_rule_form', true);">Save</button>
                                                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /opposite sidebar -->




