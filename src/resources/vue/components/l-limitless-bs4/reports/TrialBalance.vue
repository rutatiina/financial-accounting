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
                        <span class="breadcrumb-item">Accountant</span>
                        <span class="breadcrumb-item active">Trial Balance</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

            </div>
        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content border-0 p-0">

            <div class="card max-width-1280 shadow-none border-0 m-auto">
                <div class="card-header text-center">
                    <h6 class="card-title">{{this.$root.tenant.name}}</h6>
                    <h3 class="card-title">Trial Balance</h3>
                    <p>Basis: Accrual</p>
                    <!--<h6>As on 23 Jan 2020</h6>-->
                    <h6>For {{report.openingDate}} to {{report.closingDate}}</h6>
                </div>

                <div class="table-responsive overflow-visible">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 60%">ACCOUNT</th>
                                <th class="text-right">NET DEBIT <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name">{{report.currency}}</span></th>
                                <th class="text-right">NET CREDIT <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name">{{report.currency}}</span></th>
                            </tr>
                        </thead>
                        <tbody v-for="(accounts, type) in report.accounts">
                            <tr>
                                <td colspan="3" class="font-weight-bold text-capitalize">{{type}}</td>
                            </tr>
                            <tr v-for="account in accounts" v-if="account.total_debit > 0 || account.total_credit > 0 ">
                                <td class="pl-4 text-primary">{{account.name}}</td>
                                <td class="text-right">
                                    <span v-if="account.total_debit > 0">{{rgNumberFormat(account.total_debit, 2)}}</span>
                                </td>
                                <td class="text-right">
                                    <span v-if="account.total_credit > 0">{{rgNumberFormat(account.total_credit, 2)}}</span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr :class="[report.balancingFigure && report.balancingFigure !== 0 ? 'bg-danger' : '']">
                                <td class="font-weight-bold">Total</td>
                                <td class="text-right font-weight-bold">{{rgNumberFormat(report.totalDebit, 2)}}</td>
                                <td class="text-right font-weight-bold">{{rgNumberFormat(report.totalCredit, 2)}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div v-if="report.balancingFigure && report.balancingFigure !== 0"
                     class="alert alert-danger border-0 alert-dismissible mt-3">
                    <!--<button type="button" class="close" data-dismiss="alert"><span>×</span></button>-->
                    <span class="font-weight-semibold">Oh snap!</span> The Trial Balance is <span class="font-weight-semibold">NOT</span> balancing.
                </div>

                <div v-if="report.balancingFigure && report.balancingFigure !== 0"
                     class="alert alert-danger border-0 alert-dismissible">
                    <!--<button type="button" class="close" data-dismiss="alert"><span>×</span></button>-->
                    {{report.currency}} <span class="font-weight-semibold">{{rgNumberFormat(report.balancingFigure, 2)}}</span> Balancing figure.
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
        watch: {},
        mounted() {
            this.generate()
        },
        methods: {
            async generate() {
                try {
                    return await axios.post('/accounting/reports/trial-balance')
                        .then((response) => {
                            //console.log(response)
                            this.report = response.data
                        })

                } catch (e) {
                    console.log(e); //test
                }
            }
        }
    }
</script>
