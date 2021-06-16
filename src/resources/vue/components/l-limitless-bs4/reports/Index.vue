<template>

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light d-print-none">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-stats-growth mr-2"></i> <span class="font-weight-semibold">Reports</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <!--<div class="header-elements d-none">
                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                        <a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Bills</span></a>
                    </div>
                </div>-->
            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="/" class="breadcrumb-item">
                            <i class="icon-home2 mr-2"></i>
                            <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name"> {{this.$root.tenant.name | truncate(30) }} </span>
                        </a>
                        <span class="breadcrumb-item">Accounting</span>
                        <span class="breadcrumb-item active">Reports</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

            </div>
        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content border-0 p-0">

            <!-- Content area -->
            <div class="content max-width-1280">

                <div class="card card-body shadow-none border-0">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">

                                <div class="list-group border-0">
                                    <div class="list-group-item font-weight-semibold h6">
                                        <i class="icon-office mr-2"></i>
                                        Business Overview
                                    </div>

                                    <router-link to="/accounting/reports/profit-and-loss"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Profit and Loss
                                    </router-link>

                                    <a href="/accounting/reports/profit-and-loss" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Cash Flow Statement
                                    </a>

                                    <router-link to="/accounting/reports/balance-sheet"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Balance sheet
                                    </router-link>

                                    <!--<a href="/accounting/reports/trial-balance" class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Trial balance
                                    </a>-->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">

                                <div class="list-group border-0">
                                    <div class="list-group-item font-weight-semibold h6">
                                        <i class="icon-cart mr-2"></i>
                                        Sales
                                    </div>

                                    <router-link to="/accounting/reports/sales-by-customer"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Sales by Customer
                                    </router-link>

                                    <router-link to="/accounting/reports/sales-by-item"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Sales by Item
                                    </router-link>

                                    <router-link to="/accounting/reports/sales-by-salesperson"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Sales by Sales Person
                                    </router-link>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">

                                <div class="list-group border-0">
                                    <div class="list-group-item font-weight-semibold h6">
                                        <i class="icon-clipboard5 mr-2"></i>
                                        Inventory
                                    </div>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Inventory Summary
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Inventory Valuation Summary
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> FIFO Cost Lot Tracking
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Product Sales Report
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">

                                <div class="list-group border-0">
                                    <div class="list-group-item font-weight-semibold h6">
                                        <i class="icon-coin-dollar mr-2"></i>
                                        Receivables
                                    </div>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Customer Balances
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Aging Summary
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Aging Details
                                    </a>

                                    <router-link to="/accounting/reports/invoice-details"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Invoice Details
                                    </router-link>

                                    <router-link to="/accounting/reports/retainer-invoice-details"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Retainer Invoice Details
                                    </router-link>

                                    <router-link to="/accounting/reports/sales-order-details"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Sales Order Details
                                    </router-link>

                                    <router-link to="/accounting/reports/estimate-details"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Estimate Details
                                    </router-link>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">

                                <div class="list-group border-0">
                                    <div class="list-group-item font-weight-semibold h6">
                                        <i class="icon-credit-card2 mr-2"></i>
                                        Payments Received
                                    </div>

                                    <router-link to="/accounting/reports/payments-received"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Payments Received
                                    </router-link>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Time to Get Paid
                                    </a>

                                    <router-link to="/accounting/reports/credit-note-details"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Credit Note Details
                                    </router-link>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Refund History
                                    </a>

                                    <div class="list-group-item font-weight-semibold h6 mt-3">
                                        <i class="icon-stats-bars3 mr-2"></i>
                                        Recurring Invoices
                                    </div>

                                    <router-link to="/accounting/reports/recurring-invoice-details"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Recurring Invoice Details
                                    </router-link>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="list-group border-0">
                                    <div class="list-group-item font-weight-semibold h6">
                                        <i class="icon-percent mr-2"></i>
                                        Taxes
                                    </div>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Tax Summary
                                    </a>

                                    <div class="list-group-item font-weight-semibold h6 mt-3">
                                        <i class="icon-calendar2 mr-2"></i>
                                        Budgets
                                    </div>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Budget Vs Actuals
                                    </a>

                                    <div class="list-group-item font-weight-semibold h6 mt-3">
                                        <i class="icon-cash4 mr-2"></i>
                                        Currency
                                    </div>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Realized Gain or Loss
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Unrealized Gain or Loss
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="list-group border-0">
                                    <div class="list-group-item font-weight-semibold h6">
                                        <i class="icon-cash3 mr-2"></i>
                                        Payables
                                    </div>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Vendor Balances
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Aging Summary
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Aging Details
                                    </a>

                                    <router-link to="/accounting/reports/bills-details"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Bills Details
                                    </router-link>

                                    <router-link to="/accounting/reports/vendor-credits-details"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Vendor Credits Details
                                    </router-link>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Payments Made
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Refund History
                                    </a>

                                    <router-link to="/accounting/reports/purchase-order-details"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Purchase Order Details
                                    </router-link>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Purchase Orders by Vendor
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="list-group border-0">
                                    <div class="list-group-item font-weight-semibold h6">
                                        <i class="icon-bag mr-2"></i>
                                        Purchases and Expenses
                                    </div>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Purchases by Vendor
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Purchases by Item
                                    </a>

                                    <router-link to="/accounting/reports/expense-details"
                                                 class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Expense Details
                                    </router-link>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Expenses by Category
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Expenses by Customer
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Expenses by Project
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Expenses by Employee
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="list-group border-0">
                                    <div class="list-group-item font-weight-semibold h6">
                                        <i class="icon-user mr-2"></i>
                                        Accountant
                                    </div>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Account Transactions
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Account Type Summary
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> General Ledger
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Detailed General Ledger
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Journal Report
                                    </a>

                                    <router-link to="/accounting/reports/trial-balance"
                                       class="list-group-item list-group-item-action text-primary">
                                        <i class="icon-star-empty3 mr-2"></i> Trial Balance
                                    </router-link>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <!--<div class="col-md-4">
                            <div class="mb-3">
                                <div class="list-group border-0">
                                    <div class="list-group-item font-weight-semibold h6">
                                        <i class="icon-briefcase3 mr-2"></i>
                                        Projects and Timesheet
                                    </div>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Project Summary
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Project Details
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Timesheet Details
                                    </a>
                                </div>
                            </div>
                        </div>-->


                        <div class="col-md-4 d-none">
                            <div class="mb-3">
                                <div class="list-group border-0">
                                    <div class="list-group-item font-weight-semibold h6">
                                        <i class="icon-history mr-2"></i>
                                        Activity
                                    </div>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> System Mails
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Activity Logs
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Exception Report
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Portal Activities
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> Client Reviews
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> API Usage
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!--<div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">

                                <div class="list-group border-0">
                                    <div class="list-group-item font-weight-semibold h6">
                                        <i class="icon-stats-bars3 mr-2"></i>
                                        Sales
                                    </div>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> xxxxx
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> xxxxx
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> xxxxx
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">

                                <div class="list-group border-0">
                                    <div class="list-group-item font-weight-semibold h6">
                                        <i class="icon-stats-bars3 mr-2"></i>
                                        Sales
                                    </div>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> xxxxx
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> xxxxx
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> xxxxx
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">

                                <div class="list-group border-0">
                                    <div class="list-group-item font-weight-semibold h6">
                                        <i class="icon-stats-bars3 mr-2"></i>
                                        Sales
                                    </div>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> xxxxx
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> xxxxx
                                    </a>

                                    <a href="#" @click.prevent class="list-group-item list-group-item-action">
                                        <i class="icon-star-empty3 mr-2"></i> xxxxx
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>-->
                </div>

            </div>
            <!-- /content area -->

        </div>
        <!-- /content area -->


        <!-- Footer -->
        
        <!-- /footer -->

    </div>
    <!-- /main content -->

</template>

<script>

    export default {
        components: {

        },
        data() {
            return {}
        },
        watch: {},
        mounted() {
            this.$root.appMenu('accounting')
        },
        methods: {},
        ready:function(){},
        beforeUpdate: function () {},
        updated: function () {}
    }
</script>
