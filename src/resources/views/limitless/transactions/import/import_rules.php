<!-- Second navbar -->
<div class="navbar navbar-default navbar-lg rg_transaction_import_rules_onselect_btns p-10" id="navbar-second" style="display: none;">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-circle-down2"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse p-10" id="navbar-second-toggle">
        <ul class="nav navbar-nav">
            <li class="active">
                <button type="button" class="btn btn-link text-danger text-semibold rg_datatable_selected_delete" data-url="/financial-accounts/transactions/import/rules/delete/"><i class="icon-bin position-left"></i> Delete</button>
            </li>
        </ul>
    </div>
</div>
<!-- /second navbar -->


    <!-- Page header -->
    <div class="page-header" style="border-bottom: 1px solid #ddd;">
        <div class="page-header-content">
            <div class="page-title clearfix">
                <h1 class="pull-left no-margin text-light">
                    Import Transactions Rules
                </h1>

                <div class="pull-right">
                    <a href="/financial-accounts/transactions/import/" type="button" class="btn btn-danger"> View Import Que </a>
                </div>
            </div>
        </div>

    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content no-padding-left no-padding-right">

        <!-- Bordered table -->
        <div class="panel panel-flat no-border-left no-border-right no-shadow">

            <div class="table-responsive">
                <table id="rg_import_rules" class="table">
                    <thead>
                    <tr>
                        <th class="hide_sort_icon" width="12"> </th>
                        <th width="100" class="text-semibold">Status</th>
                        <th>Name</th>
                        <th>Entree Name</th>
                        <th>Criteria</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($import_rules as $import_rule) { ?>
                    <tr>
                        <td><?php echo $import_rule->id; ?></td>
                        <td><span class="label label-success">Active</span></td>
                        <td><?php echo $import_rule->name; ?></td>
                        <td><?php echo $import_rule->txn_entree_name; ?></td>
                        <td>
                            <?php
                            foreach (json_decode($import_rule->criteria) as $criteria) {
                                echo '<p>';
                                echo '<span class="label label-default">' . $criteria->column . '</span> ';
                                echo '<span class="label label-default">' . $criteria->condition . '</span> ';
                                echo '<span class="label label-danger" style="text-transform: inherit;">' . $criteria->value . '</span>';
                                echo '</p>';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /bordered table -->

    </div>
    <!-- /content area -->

    <!-- Opposite sidebar -->
    <?php $this->load->view('transaction/import_sidebar_opposite'); ?>
    <!-- /opposite sidebar -->




