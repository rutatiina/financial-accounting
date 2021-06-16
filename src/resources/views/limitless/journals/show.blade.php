<!-- Main content -->
<div class="content-wrapper">

    <?php /*
    <!-- Page header -->
    <div class="page-header hidden-print">

        <div class="breadcrumb-line p-15"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            
            <div class="btn-group pull-left">
                <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="font-size:14px;">
                    <i class=" icon-add-to-list position-left"></i> Options <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-left">
                    <li><a href="/contacts/update/<?php echo $transaction['debit_contact_id']; ?>"><i class="icon-pencil7"></i> Edit Contact</a></li>
                    <li><a href="#"><i class="icon-file-pdf"></i> Download Pdf</a></li>
                    <li class="divider"></li>
                    <li><a href="#" class="rg_datatable_row_delete text-danger" data-url="/transaction/delete/<?php echo $transaction['id']; ?>"><i class="icon-bin"></i> Delete</a></li>
                </ul>
            </div>   
        
            <div class="pull-right">
                <div class="btn-group mr-10">
                    <button data-href="/sales/extimate/<?php echo $transaction['id']; ?>" type="button" class="btn btn-default btn-icon"><i class="icon-pencil3"></i></button>
                    <button data-href="/sales/pdf/<?php echo $transaction['id']; ?>" type="button" class="btn btn-default btn-icon"><i class="icon-file-pdf"></i></button>
                    <button onclick="window.print();" type="button" class="btn btn-default btn-icon"><i class="icon-printer2"></i></button>
                    <!--<button type="button" class="btn btn-default btn-icon"><i class="icon-alarm"></i></button>-->
                    <button type="button" class="btn btn-danger btn-icon"><i class="icon-envelop"></i></button>
                </div>

                <button type="button" class="btn btn-default btn-icon mr-10"><i class="icon-attachment"></i></button>

            </div> 

        </div>
    </div>
    <!-- /page header -->
    */ ?>

    <!-- Content area -->
    <div class="content">


        <div class="panel panel-flat no-border no-shadow "><!--pt-15-->
            
            <div class="panel-body no-padding">
                <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-bottom hidden-print">
                        <li class="active"><a href="#bottom-tab1" data-toggle="tab">Journal Entry</a></li>
                    </ul>

                    <div class="tab-content p-20">
                        <div class="tab-pane active" id="bottom-tab1">
                        
                            <div class="max-width-1040" style="margin: 50px auto;">

                                <!-- Invoice template -->
                                <div class="panel panel-white no-border-radius">

                                    <div class="panel-body no-padding-bottom">
                                        <div class="row">
                                            <div class="col-xs-6 content-group">
                                                <?php if ( !empty($current_client->logo) && file_exists($_SERVER['DOCUMENT_ROOT'] . $current_client->logo) ) { ?>
                                                    <img src="<?php echo $current_client->logo; ?>" class=" mt-5" alt="" style="max-width: 120px; max-height: 100px;">
                                                <?php } else { ?>
                                                    <img src="/images/nologo.png" class=" mt-5" alt="" style="max-width: 120px; max-height: 100px;">
                                                <?php } ?>

                                                <ul class="list-condensed list-unstyled">
                                                    <li><h5><?php echo $current_client->name; ?></h5></li>
                                                    <?php if ($current_client->street_line_1) { ?><li><?php echo $current_client->street_line_1; ?></li><?php } ?>
                                                    <?php if ($current_client->street_line_2) { ?><li><?php echo $current_client->street_line_2; ?></li><?php } ?>
                                                    <?php if ($current_client->city) { ?><li><?php echo $current_client->city; ?></li><?php } ?>
                                                    <?php if ($current_client->state_province) { ?><li><?php echo $current_client->state_province; ?></li><?php } ?>
                                                    <?php if ($current_client->phone) { ?><li><?php echo $current_client->phone; ?></li><?php } ?>
                                                    <?php if ($current_client->email) { ?><li><?php echo $current_client->website; ?></li><?php } ?>
                                                </ul>
                                            </div>

                                            <div class="col-xs-6 content-group">
                                                <div class="invoice-details text-right">
                                                    <h1 class="text-uppercase text-semibold no-margin-top">Journal Entry</h1>
                                                    <h5 class="text-danger no-margin-top"><?php echo $transaction['number']; ?></h5>
                                                    <ul class="list-condensed list-unstyled">
                                                        <li>Date: <span class="text-semibold"><?php echo $transaction['date']; ?></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-lg">
                                            <thead>
                                            <tr class="">
                                                <th class="col-sm-4 border-bottom-grey-300 text-uppercase">Account / Description</th>
                                                <th class="col-sm-4 text-uppercase">Contact</th>
                                                <th class="col-sm-1 text-right text-uppercase">Debit</th>
                                                <th class="col-sm-1 text-right text-uppercase">Credit</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($transaction['items'] as $item) { ?>
                                                    <tr>
                                                        <td>
                                                            <?php if ($item['name']) { ?><h6 class="no-margin"><?php echo $item['name']; ?></h6><?php } ?>
                                                            <?php if ($item['description']) { ?><span><?php echo $item['description']; ?></span><?php } ?>
                                                        </td>
                                                        <td class=""><?php echo $item['contact']['name']; ?></td>
                                                        <td class="text-right"><span class="text-semibold"><?php echo $item['debit']; ?></span></td>
                                                        <td class="text-right"><span class="text-semibold"><?php echo $item['credit']; ?></span></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="panel-body">
                                        <div class="row invoice-payment">
                                            <div class="col-xs-8">
                                                <div class="content-group">

                                                    <?php /*
                                                    <h6>Authorized person</h6>
                                                    <div class="mb-15 mt-15">
                                                        <img src="assets/images/signature.png" class="display-block" style="width: 150px;" alt="">
                                                    </div>
                                                    
                                                    <ul class="list-condensed list-unstyled text-muted">
                                                        <li>Eugene Kopyov</li>
                                                        <li>2269 Elba Lane</li>
                                                        <li>Paris, France</li>
                                                        <li>888-555-2311</li>
                                                    </ul>
                                                    */ ?>
                                                </div>
                                            </div>

                                            <div class="col-xs-4">
                                                <div class="content-group">
                                                    <!--<h6>Total due</h6>-->
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                            <tr>
                                                                <th class="no-border">TOTAL (<?php echo $transaction['base_currency']; ?>)</th>
                                                                <td class="no-border text-right no-padding-right"><h5 class="text-semibold"><?php echo number_format($transaction['total']); ?></h5></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <!--<h6>Amount in words:</h6>
                                        <p class="text-muted amount_in_words"></p>-->
                                    </div>

                                </div>
                                <!-- /invoice template -->
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- Footer -->
        <div class="footer hidden-print text-muted">
            &copy; <?php echo date('Y'); ?>. Maccounts - Financial, Payroll and Inventory accounting.
        </div>
        <!-- /footer -->

    </div>
    <!-- /content area -->

</div>
<!-- /main content -->

