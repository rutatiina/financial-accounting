<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header border-bottom border-bottom-grey-300">
        <div class="page-header-content">
            <div class="page-title">
                <h1 class="no-margin text-light">
                    <i class="icon-file-plus position-left"></i> Report options
                    <small>options for a report</small>
                </h1>
            </div>
        </div>

    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content no-border no-padding">

        <!-- Form horizontal -->
        <div class="panel panel-flat no-border no-shadow">

            <div class="panel-body">

                <form action="<?php echo $report_url; ?>" method="get" class="form-horizontal">

                    <?php /*<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />*/ ?>
                    <?php /*<input type="hidden" name="report_url" value="<?php echo $report_url; ?>" />*/ ?>

                    <?php if (in_array('contact_id', $options_fields)) { ?>
                    <fieldset class="pt-20 pl-20 mb-20" style="background: #fcfcfc; border: 1px solid #eee;">

                        <div class="form-group">
                            <div class="max-width-1040">
                                <label class="control-label col-lg-2">Choose contact</label>
                                <div class="col-lg-6">
                                
                                    <select class="select-search" name="contact_id" data-placeholder="Select customer ..." data-allow-clear="true">
                                        <option></option>
                                        <?php foreach($contacts as $category) { ?>
                                            <optgroup label="<?php echo $category['text']; ?>">
                                                <?php foreach($category['children'] as $contact) { ?>
                                                    <option value="<?php echo $contact['id']; ?>" <?php if ($contact['id'] == @$txn['debit_contact_id'] ) echo 'selected'; ?>><?php echo $contact['text']; ?></option>
                                                <?php } ?>
                                            </optgroup>
                                        <?php } ?>
                                    </select>
                                
                                </div>
                            </div>
                        </div>

                    </fieldset>
                    <?php } ?>

                    <fieldset class="p-20">

                        <?php if (in_array('opening_date', $options_fields)) { ?>
                        <div class="form-group">
                            <div class="max-width-1040">
                                <label class="col-lg-2 control-label">Opening date</label>
                                <div class="col-lg-4">
                                    <input type="text" name="opening_date" value="<?php echo date('Y-m-').'01'; ?>" class="form-control input-roundless daterange-single" placeholder="Opening date">
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if (in_array('closing_date', $options_fields)) { ?>
                        <div class="form-group">
                            <div class="max-width-1040">
                                <label class="col-lg-2 control-label">
                                    Closing date
                                </label>
                                <div class="col-lg-4">
                                    <input type="text" name="closing_date" value="" class="form-control input-roundless daterange-single" placeholder="Closing date">
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if (in_array('account_id', $options_fields)) { ?>
                        <div class="form-group">
                            <div class="max-width-1040">
                                <label class="col-lg-2 control-label">
                                    Account
                                </label>
                                <div class="col-lg-4">
                                    <select class="select-search" name="account_id" data-placeholder="Account ..." data-allow-clear="true">
                                        <option value="3" <?php if ( @$txn['debit_contact_id'] == 3 ) echo 'selected'; ?>>Cash</option>
                                        <!--<option value="Bank">Bank</option>-->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php /*<div class="form-group">
                            <div class="max-width-1040">
                                <label class="col-lg-2 control-label">
                                    Reference:
                                </label>
                                <div class="col-lg-4">
                                    <input type="text" name="reference" value="<?php echo @$txn['reference']; ?>" class="form-control input-roundless" placeholder="Enter reference">
                                </div>
                            </div>                            
                        </div>*/ ?>

                        <div class="form-group">
                            <div class="max-width-1040">
                                <label class="col-lg-2 control-label"> </label>
                                <div class="col-lg-4">
                                <button type="submit" class="btn btn-success btn-labeled text-bold pr-20"><b><i class="icon-cog"></i></b>Generate report</button>
                                </div>
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


