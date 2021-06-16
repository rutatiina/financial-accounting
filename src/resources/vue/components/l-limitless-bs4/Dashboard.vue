<template>

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light d-print-none">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-stats-growth mr-2"></i> <span class="font-weight-semibold">Dashboard</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="/" class="breadcrumb-item">
                            <i class="icon-home2 mr-2"></i>
                            <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name"> {{this.$root.tenant.name | truncate(30) }} </span>
                        </a>
                        <span class="breadcrumb-item">Accounting</span>
                        <span class="breadcrumb-item active">Dashboard</span>
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

                <div class="row">
                    <div class="col-sm-6 col-xl-3">
                        <total-receviable></total-receviable>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <total-payable></total-payable>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <total-income></total-income>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <total-expenses></total-expenses>
                    </div>
                </div>

                <div class="card card-body shadow-none border-0 p-0">
                    <div class="row">
                        <div class="col-12">
                            <apex-chart-incomes-and-expenses></apex-chart-incomes-and-expenses>
                        </div>
                    </div>
                </div>

                <!--<div class="row">

                    <div class="col-3">
                        <div class="card card-body shadow-none border-0">
                            <apex-chart02></apex-chart02>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card card-body shadow-none border-0">
                            <apex-chart01></apex-chart01>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card card-body shadow-none border-0">
                            <apex-chart03></apex-chart03>
                        </div>
                    </div>

                </div>-->



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

    import ApexChartIncomesAndExpenses from './apex-charts/IncomesAndExpenses.vue'

    import TotalExpenses from './widgets/TotalExpenses'
    import TotalPayable from './widgets/TotalPayable'
    import TotalIncome from './widgets/TotalIncome'
    import TotalReceviable from './widgets/TotalReceviable'

    //import ApexChart01 from './apex-charts/01.vue'
    //import ApexChart02 from './apex-charts/02.vue'
    //import ApexChart03 from './apex-charts/03.vue'

    export default {
        components: {
            ApexChartIncomesAndExpenses,

            TotalExpenses,
            TotalPayable,
            TotalIncome,
            TotalReceviable,

            //ApexChart01,
            //ApexChart02,
            //ApexChart03
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
