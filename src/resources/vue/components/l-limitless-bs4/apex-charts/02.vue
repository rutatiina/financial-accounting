<template>

    <!-- cards go here -->
    <div id="chart">
        <apexchart type=pie height="260" :options="chartOptions" :series="series" />
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
                series: [44, 55, 13, 43, 22],
                chartOptions: {
                    labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                    legend: {
                        show: false
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
