@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Accounting :: Reports')

@section('head')
    {{--<script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/chat_of_account.js') }}"></script>--}}
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h1 class="no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Reports
                        <small>Invoices for products sold or services to contact(s).</small>
                    </h1>
                </div>
            </div>

        </div>


        <!-- Content area -->
        <div class="content no-border no-padding">

            <!-- Form horizontal -->
            <div class="panel panel-flat no-border no-shadow no-padding">


                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="content-group">
                                <h6 class="text-semibold heading-divided"><i class="icon-folder6 position-left"></i> Overview <small class="position-right">(5)</small></h6>
                                <div class="list-group no-border">

                                    <a href="{{route('accounting.reports.account-statement.index')}}" class="list-group-item">
                                        <i class="icon-file-text2"></i> Account Statement
                                    </a>

                                    <a href="{{route('accounting.reports.profit-and-loss.index')}}" class="list-group-item">
                                        <i class="icon-file-text2"></i> Profit and loss (Income statement) <span class="label label-primary">Popular</span>
                                    </a>

                                    <a href="{{route('accounting.reports.balance-sheet.index')}}" class="list-group-item">
                                        <i class="icon-file-text2"></i> Balance sheet
                                    </a>

                                    <a href="{{route('accounting.reports.trial-balance.index')}}" class="list-group-item">
                                        <i class="icon-file-text2"></i> Trial balance
                                    </a>

                                    <!-- <a href="#/reports/customer_statement" class="list-group-item">
                                        <i class="icon-file-text2"></i> Customer statement
                                    </a>

                                    <a href="#/reports/supplier_statement" class="list-group-item">
                                        <i class="icon-file-text2"></i> Supplier statement
                                    </a>-->
                                </div>
                            </div>
                        </div>

                        <?php /*
                        <div class="col-md-4">
                            <div class="content-group">
                                <h6 class="text-semibold heading-divided"><i class="icon-folder6 position-left"></i> Sales <small class="position-right">(3)</small></h6>
                                <div class="list-group no-border">
                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Sales by Customer
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Sales by Item <span class="label label-success">Review</span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Sales by Salesperson
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> -------------------
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-arrow-right22"></i> Show all articles (56)
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="content-group">
                                <h6 class="text-semibold heading-divided"><i class="icon-folder6 position-left"></i> Invetory <small class="position-right">(4)</small></h6>
                                <div class="list-group no-border">
                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Inventory summary <span class="label label-danger">Closed</span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Inventory Valuation summary
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> FIFO Cost lot tractracking <span class="label bg-indigo-300">Article</span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> -------------------
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-arrow-right22"></i> Show all articles (29)
                                    </a>
                                </div>
                            </div>
                        </div>
                        */ ?>
                    </div>

                    <?php /*
                    <div class="row">
                        <div class="col-md-4">
                            <div class="content-group">
                                <h6 class="text-semibold heading-divided"><i class="icon-folder6 position-left"></i> Receivables <small class="position-right">(5)</small></h6>
                                <div class="list-group no-border">
                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Customer Balances <span class="label bg-teal-300">New</span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Aging Summary
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Aging details
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Invoice Details
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Retailer Invoice Details
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Sales Order Details
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Estimate Details
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-arrow-right22"></i> Show all articles (3)
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="content-group">
                                <h6 class="text-semibold heading-divided"><i class="icon-folder6 position-left"></i> Payment Received <small class="position-right">(92)</small></h6>
                                <div class="list-group no-border">
                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Payments Received <span class="label label-primary">Popular</span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Time to get paid
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Credit Note Details
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Refund History <span class="label label-danger">Closed</span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-arrow-right22"></i> Show all articles (92)
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="content-group">
                                <h6 class="text-semibold heading-divided"><i class="icon-folder6 position-left"></i> Recurring Invoice <small class="position-right">(15)</small></h6>
                                <div class="list-group no-border">
                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Recurring Invoice Details <span class="label bg-indigo-300">Article</span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-arrow-right22"></i> Show all articles (15)
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="content-group">
                                <h6 class="text-semibold heading-divided"><i class="icon-folder6 position-left"></i> Payables <small class="position-right">(12)</small></h6>
                                <div class="list-group no-border">
                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Vendor Balances <span class="label label-danger">Closed</span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Aging Summary
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Aging Details <span class="label label-success">Review</span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Refund History
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Purchase Order Details
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Purchase Order by Vendor
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-arrow-right22"></i> Show all articles (12)
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="content-group">
                                <h6 class="text-semibold heading-divided"><i class="icon-folder6 position-left"></i> Purchasess and Expenses <small class="position-right">(34)</small></h6>
                                <div class="list-group no-border">
                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Purchases by Vendor
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Purchases by Item <span class="label label-success">Review</span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Expenses Details
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Expenses by Project
                                    </a>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Mileage Expenses by Claimant
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-arrow-right22"></i> Show all articles (34)
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="content-group">
                                <h6 class="text-semibold heading-divided"><i class="icon-folder6 position-left"></i> Taxes <small class="position-right">(85)</small></h6>
                                <div class="list-group no-border">
                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Tax Summary
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-arrow-right22"></i> Show all articles (85)
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="content-group">
                                <h6 class="text-semibold heading-divided"><i class="icon-folder6 position-left"></i> Accoutant <small class="position-right">(85)</small></h6>
                                <div class="list-group no-border">
                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Account Transaction
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> General Ledger
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Journal Report
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Trial Balance
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-arrow-right22"></i> Show all articles (85)
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="content-group">
                                <h6 class="text-semibold heading-divided"><i class="icon-folder6 position-left"></i> currency <small class="position-right">(85)</small></h6>
                                <div class="list-group no-border">
                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Realized Gain or Loss
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text2"></i> Unrealized Gain or Loss
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-arrow-right22"></i> Show all articles (85)
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                    </div>
                    */ ?>

                </div>

            </div>
            <!-- /form horizontal -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->
@endsection
