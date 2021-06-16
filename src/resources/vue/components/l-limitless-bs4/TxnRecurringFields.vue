<template>

    <div v-if="$parent.txnAttributes.isRecurring">

        <fieldset>

            <div class="form-group row">

                <label class="col-lg-2 col-form-label">
                    Frequency & Date range
                </label>
                <div class="col-lg-5">
                    <div id="recurring_measurement" class="">
                        <model-select
                            :options="txnRecurring.frequency"
                            v-model="$parent.txnAttributes.recurring.frequency"
                            placeholder="Select frequency">
                        </model-select>
                    </div>
                </div>

                <div class="col-lg-3" title="Date range">
                    <date-picker v-model="$parent.txnAttributes.recurring.date_range"
                                 valueType="format"
                                 confirm
                                 :lang="vue2DatePicker.lang"
                                 range
                                 :shortcuts="[]"
                                 class="w-100 h-100">
                    </date-picker>
                </div>

                <div class="col-lg-2" title="Status">
                    <model-select
                        :options="txnRecurring.status"
                        v-model="$parent.txnAttributes.recurring.status"
                        placeholder="Status">
                    </model-select>
                </div>

            </div>

            <div class="form-group row" v-if="$parent.txnAttributes.recurring.frequency === 'custom'">

                <label class="col-lg-2 col-form-label">

                </label>

                <div class="col-lg-5" title="Day of the week">
                    <model-select
                        :options="txnRecurring.month"
                        v-model="$parent.txnAttributes.recurring.month"
                        placeholder="Month">
                    </model-select>
                </div>

                <div class="col-lg-3" title="Day of the week">
                    <model-select
                        :options="txnRecurring.dayOfWeek"
                        v-model="$parent.txnAttributes.recurring.day_of_week"
                        placeholder="Day of week">
                    </model-select>
                </div>

                <div class="col-lg-2" title="Day of the month">
                    <model-select
                        :options="txnRecurringDayOfMonth"
                        v-model="$parent.txnAttributes.recurring.day_of_month"
                        placeholder="Day of month">
                    </model-select>
                </div>

            </div>

        </fieldset>

    </div>

</template>

<script>

    export default {
        //name: 'AccountingTxnRecurringFields',
        components: {},
        data() {
            return {
                txnRecurring:{
                    frequency: [
                        { value: 'everyMinute', text: 'Every Minute - repeat every minute' },

                        { value: 'monthly', text: 'Monthly - repeat every month on this day' },
                        { value: 'hourly', text: 'Hourly - repeat every hour of each day' },
                        { value: 'daily', text: 'Daily - repeat everyday' },
                        { value: 'weekly', text: 'Weekly - repeat every week on this day' },
                        { value: 'fortnight', text: 'Fortnight - on this day' },
                        { value: '2months', text: 'Every 2 Months - on this day' },
                        { value: '3months', text: 'Every 3 Months - this day' },
                        { value: 'annually', text: 'Annually - repeat every year on this month and day' },
                        { value: 'custom', text: 'Custom - month, day of week & day of month to repeat' },

                        { value: 'everyTwoHours', text: 'Repeat every two hours' },
                        { value: 'everyThreeHours', text: 'Repeat every three hours' },
                        { value: 'everyFourHours', text: 'Repeat every four hours' },
                        { value: 'everySixHours', text: 'Repeat every six hours' }
                    ],
                    month: [
                        { value: '*', text: 'Any month' },
                        { value: '1', text: 'January' },
                        { value: '2', text: 'February' },
                        { value: '3', text: 'March' },
                        { value: '4', text: 'April' },
                        { value: '5', text: 'May' },
                        { value: '6', text: 'June' },
                        { value: '7', text: 'July' },
                        { value: '8', text: 'August' },
                        { value: '9', text: 'September' },
                        { value: '10', text: 'October' },
                        { value: '11', text: 'November' },
                        { value: '12', text: 'December' }
                    ],
                    dayOfWeek: [
                        { value: '*', text: 'Any day of the week' },
                        { value: '0', text: 'Sunday' },
                        { value: '1', text: 'Monday' },
                        { value: '2', text: 'Tuesday' },
                        { value: '3', text: 'Wednesday' },
                        { value: '4', text: 'Thursday' },
                        { value: '5', text: 'Friday' },
                        { value: '6', text: 'Saturday' }
                    ],
                    status: [
                        { value: 'active', text: 'Active' },
                        { value: 'paused', text: 'Paused' },
                        { value: 'de-active', text: 'De-active' },
                    ]
                },
            }
        },
        computed: {
            // a computed getter
            txnRecurringDayOfMonth: function () {
                let o = []
                o.push({ value: '*', text: 'Any Day' })
                let i;
                for (i = 1; i <= 31; i++) {
                    o.push({ value: i, text: i })
                }
                return o
            }
        },
        created: function () {},
        mounted() {},
        methods: {},
        beforeUpdate: function () {},
        updated: function () {},
        destroyed: function () {}
    }
</script>
