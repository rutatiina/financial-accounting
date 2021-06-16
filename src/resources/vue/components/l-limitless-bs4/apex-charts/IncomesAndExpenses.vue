<template>

    <!-- cards go here -->
    <div id="chart">
        <apexchart type=line height=450 :options="chartOptions" :series="series" />
    </div>

</template>

<script>

    import VueApexCharts from 'vue-apexcharts'

    export default {
        name: 'ApexChartsArea',
        components: {
            apexchart: VueApexCharts,
        },
        data() {
            return {
                series: [],
                chartOptions: {}
            }
        },
        methods: {
            async fetchMonthlyExpense() {
                try {
                    return await axios.get('/financial-accounts/dashboard/incomes-and-expense')
                        .then(response => {

                            let co = response.data.chartOptions;

                            co.yaxis.labels.formatter = (value) => {
                                return this.$root.tenant.base_currency + ' ' + this.rgNumberFormat(value, 2);
                            }

                            co.xaxis.labels.formatter = (value) => { return value }

                            co.dataLabels.formatter = (val, opt) => {
                                //console.log(val, opt)
                                return this.rgNumberFormat(val);
                                //return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                            }

                            //console.log(co)

                            this.series = response.data.series
                            this.chartOptions = co //response.data.chartOptions

                        })

                } catch (e) {
                    //console.log(e);
                }
            }
        },
        mounted() {
            this.fetchMonthlyExpense()
        },
    }
</script>
