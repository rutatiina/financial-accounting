<template>

    <div class="card card-body">
        <div class="media">
            <div class="mr-3 align-self-center">
                <i class="icon-coin-dollar icon-3x text-danger-400"></i>
            </div>

            <div class="media-body text-right">
                <h4 class="font-weight-semibold mb-0">{{rgNumberFormat(widgetData, 2)}}</h4>
                <span class="badge badge-danger badge-pill font-weight-bold">Total Expenses</span>
                <span class="badge badge-secondary badge-pill font-weight-bold">{{$root.tenant.base_currency}}</span>
            </div>
        </div>
    </div>

</template>

<script>

    export default {
        data() {
            return {
                widgetData: 0
            }
        },
        methods: {
            async fetchWidgetData() {
                try {
                    return await axios.get('/financial-accounts/widgets/total-expenses')
                        .then(response => {
                            this.widgetData = response.data
                        })

                } catch (e) {
                    //console.log(e);
                }
            }
        },
        mounted() {
            this.fetchWidgetData()
        },
    }
</script>
