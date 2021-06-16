<template>

    <div class="card card-body">
        <div class="media">
            <div class="mr-3 align-self-center">
                <i class="icon-cash3 icon-3x text-blue-400"></i>
            </div>

            <div class="media-body text-right">
                <h4 class="font-weight-semibold mb-0">{{rgNumberFormat(widgetData, 2)}}</h4>
                <span class="badge bg-blue-400 badge-pill font-weight-bold">Total Income</span>
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
                    return await axios.get('/financial-accounts/widgets/total-income')
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
