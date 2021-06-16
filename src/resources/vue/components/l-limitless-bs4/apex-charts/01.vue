<template>

    <!-- cards go here -->
    <div id="chart">
        <apexchart type=radialBar height="230" :options="chartOptions" :series="series" />
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
                series: [67],
                chartOptions: {
                    chart: {
                        offsetY: -10,
                    },
                    plotOptions: {
                        radialBar: {
                            startAngle: -135,
                            endAngle: 135,
                            dataLabels: {
                                name: {
                                    fontSize: '16px',
                                    color: undefined,
                                    offsetY: 120
                                },
                                value: {
                                    offsetY: 76,
                                    fontSize: '22px',
                                    color: undefined,
                                    formatter: function (val) {
                                        return val + "%";
                                    }
                                }
                            }
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'dark',
                            shadeIntensity: 0.15,
                            inverseColors: false,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 50, 65, 91]
                        },
                    },
                    stroke: {
                        dashArray: 4
                    },
                    labels: ['Business Risk']
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
