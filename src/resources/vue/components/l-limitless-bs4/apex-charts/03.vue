<template>

    <!-- cards go here -->
    <div id="chart">
        <apexchart type=bar height="200" :options="chartOptions" :series="series" />
    </div>

</template>

<script>

    import VueApexCharts from 'vue-apexcharts'

    export default {
        components: {
            apexchart: VueApexCharts,
        },
        data() {
            return {
                series: [{
                    data: [47, 45, 74, 14, 56, 74, 14, 11, 7, 39, 82, 45, 74, 14, 56, 74, 14, 11, 7, 39, 82, 45, 74, 14, 56, 74, 14, 11, 7, 39, 82]
                }],
                chartOptions: {
                    chart: {
                        sparkline: {
                            enabled: true
                        },
                    },
                    stroke: {
                        curve: 'straight'
                    },
                    xaxis: {
                        crosshairs: {
                            width: 1
                        },
                    },
                    yaxis: {
                        min: 0
                    },
                    title: {
                        text: '$235,312',
                        offsetX: 0,
                        style: {
                            fontSize: '24px',
                            //cssClass: 'apexcharts-yaxis-title'
                        }
                    },
                    subtitle: {
                        text: 'Expenses',
                        offsetX: 0,
                        style: {
                            fontSize: '14px',
                            //cssClass: 'apexcharts-yaxis-title'
                        }
                    }
                }
            }
        },
        methods: {
            async fetchMonthlyExpense() {
                try {
                    return await axios.get('/financial-accounts/dashboard/incomes-and-expense')
                        .then(response => {
                            //*
                            //console.log(response.data.chartOptions)
                            let currentObj = this;
                            let co = response.data.chartOptions;
                            co.yaxis.labels.formatter = function (value) {
                                return currentObj.$root.tenant.base_currency + ' ' + currentObj.rgNumberFormat(value, 2);
                            }
                            //console.log(co)
                            //*/
                            this.series = response.data.series
                            this.chartOptions = co //response.data.chartOptions
                        })

                } catch (e) {
                    //console.log(e);
                }
            }
        },
        mounted() {
            //this.fetchMonthlyExpense()
        },
    }
</script>
