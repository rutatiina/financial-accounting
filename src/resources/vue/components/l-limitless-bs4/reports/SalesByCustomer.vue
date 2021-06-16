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
                        <span class="breadcrumb-item">Sales</span>
                        <span class="breadcrumb-item active">Sales by Customer</span>
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
                    <h3 class="card-title">Sales by Customer</h3>
                    <p>Basis: Accrual</p>
                    <!--<h6>As on 23 Jan 2020</h6>-->
                    <h6>For {{report.opening_date}} to {{report.closing_date}}</h6>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 60%">NAME</th>
                                <th class="text-right">INVOICE COUNT</th>
                                <th class="text-right">SALES <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name">{{report.currency}}</span></th>
                                <th class="text-right">SALES WITH TAX <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name">{{report.currency}}</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="contact in report.contacts">
                                <!--v-if="contact.sales > 0 || contact.sales_with_tax > 0 "-->
                                <td class="pl-4 text-primary">{{contact.name}}</td>
                                <td class="text-right">{{contact.invoice_count}}</td>
                                <td class="text-right">
                                    <span>{{rgNumberFormat(contact.sales, 2)}}</span>
                                </td>
                                <td class="text-right">
                                    <span>{{rgNumberFormat(contact.sales_with_tax, 2)}}</span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr :class="[report.balancingFigure && report.balancingFigure !== 0 ? 'bg-danger' : '']">
                                <td class="font-weight-bold">Total</td>
                                <td class="text-right font-weight-bold">{{rgNumberFormat(report.total_invoices, 2)}}</td>
                                <td class="text-right font-weight-bold">{{rgNumberFormat(report.total_sales, 2)}}</td>
                                <td class="text-right font-weight-bold">{{rgNumberFormat(report.total_sales_with_tax, 2)}}</td>
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
                    return await axios.post('/accounting/reports/sales-by-customer')
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
