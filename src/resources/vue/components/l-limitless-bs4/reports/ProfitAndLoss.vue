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
                        <span class="breadcrumb-item active">Profit And Loss</span>
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
                    <h3 class="card-title">Profit And Loss</h3>
                    <p>Basis: Accrual</p>
                    <!--<h6>As on 23 Jan 2020</h6>-->
                    <h6>For {{report.opening_date}} to {{report.closing_date}}</h6>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 60%">ACCOUNT</th>
                                <th class="text-right">BALANCE <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name">{{report.currency}}</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3" class="font-weight-bold text-capitalize">Incomes</td>
                            </tr>
                            <tr v-for="account in report.incomes">
                                <td class="pl-4 text-primary">{{account.name}}</td>
                                <td class="text-right">{{rgNumberFormat(account.balance_account, 2)}}</td>
                            </tr>
                            <tr>
                                <td class="pl-4 font-weight-semibold">Total Income</td>
                                <td class="text-right">{{rgNumberFormat(report.total_income, 2)}}</td>
                            </tr>
                            <tr>
                                <td class="pl-4">Cost of sales</td>
                                <td class="text-right">{{rgNumberFormat(report.total_cost_of_sales, 2)}}</td>
                            </tr>
                            <tr>
                                <td class="pl-4 font-weight-semibold">Gross Profit</td>
                                <td class="text-right font-weight-semibold">{{rgNumberFormat(report.gross_profit_or_loss, 2)}}</td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="3" class="font-weight-bold text-capitalize">Expenses</td>
                            </tr>
                            <tr v-for="account in report.expenses">
                                <td class="pl-4 text-primary">{{account.name}}</td>
                                <td class="text-right">{{rgNumberFormat(account.balance_account, 2)}}</td>
                            </tr>
                            <tr>
                                <td class="pl-4 font-weight-semibold">Total Expense</td>
                                <td class="text-right">{{rgNumberFormat(report.total_expense, 2)}}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td v-if="report.net_profit_or_loss < 0" class="font-weight-bold">Net Loss</td>
                                <td v-else class="font-weight-bold">Net Profit</td>
                                <td class="text-right font-weight-bold">{{rgNumberFormat(report.net_profit_or_loss, 2)}}</td>
                            </tr>
                        </tfoot>
                    </table>
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
                    return await axios.post('/accounting/reports/profit-and-loss')
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
