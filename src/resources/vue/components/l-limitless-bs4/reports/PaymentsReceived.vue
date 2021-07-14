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
                        <span class="breadcrumb-item">Reports</span>
                        <span class="breadcrumb-item">Payments Received</span>
                        <span class="breadcrumb-item active">Payments Received</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

            </div>
        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content border-0 p-0">

            <div class="card shadow-none border-0 m-auto">
                <div class="card-header text-center">
                    <h6 class="card-title">{{this.$root.tenant.name}}</h6>
                    <h3 class="card-title">Payments Received</h3>
                    <p>Basis: Accrual</p>
                    <!--<h6>As on 23 Jan 2020</h6>-->
                    <h6 v-if="tableData.response">For {{tableData.response.opening_date}} to {{tableData.response.closing_date}}</h6>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>PAYMENT NUMBER</th>
                                <th>DATE</th>
                                <th>REFERENCE</th>
                                <th>CUSTOMER NAME</th>
                                <th>PAYMENT MODE</th>
                                <th>NOTES</th>
                                <th>INVOICE #</th>
                                <th class="text-right">AMOUNT (FCY)</th>
                                <th class="text-right">UNUSED AMOUNT (FCY)</th>
                                <th class="text-right">AMOUNT (BCY)</th>
                                <th class="text-right">UNUSED AMOUNT (BCY)</th>
                            </tr>
                        </thead>

                        <rg-tables-state></rg-tables-state>

                        <tbody>
                            <tr v-for="row in tableData.payload.data">
                                <td>{{row.number}}</td>
                                <td>{{row.date}}</td>
                                <td>{{row.reference}}</td>
                                <td>{{row.contact_name}}</td>
                                <td>{{row.payment_mode}}</td>
                                <td> </td>
                                <td> </td>
                                <td class="cursor-pointer font-weight-bold text-right">
                                    <span class="text-slate-800">{{rgNumberFormat(row.total, 2)}}</span>
                                    <small>{{row.base_currency}}</small>
                                </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                            </tr>
                        </tbody>
                    </table>

                    <rg-tables-pagination v-bind:table-data-prop="tableData"></rg-tables-pagination>

                </div>

                <div class="mb-5"></div>

            </div>

        </div>
        <!-- /content area -->


        <!-- Footer -->
        
        <!-- /footer -->

    </div>
    <!-- /main content -->

</template>

<script>

    export default {
        data() {
            return {
                report:{}
            }
        },
        watch: {
            '$route.query.page': function (page) {
                this.tableData.url = '/accounting/reports/payments-received' + '?page=' + page;
            }
        },
        mounted() {

            this.tableData.method = 'post'
            this.tableData.initiate = true

            //page height - 230(page header and breadcrump) - 80 (lower space) / 45 (height of each row)
            this.tableRecordsPerPage(230, 80, 45)

            if (this.$route.query.page === undefined) {
                this.tableData.url = '/accounting/reports/payments-received';
            } else {
                this.tableData.url = '/accounting/reports/payments-received' + '?page='+this.$route.query.page;
            }

        },
        methods: {
        }
    }
</script>
