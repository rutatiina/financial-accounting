<?php

namespace Rutatiina\FinancialAccounting\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Rutatiina\RecurringBill\Models\RecurringBillRecurring;
use Rutatiina\RecurringExpense\Models\RecurringExpenseRecurring;
use Rutatiina\RecurringInvoice\Models\RecurringInvoiceRecurring;
use Rutatiina\RecurringInvoice\Classes\Schedule as RecurringInvoiceScheduleClass;
use Rutatiina\RecurringBill\Classes\Schedule as RecurringBillScheduleClass;
use Rutatiina\RecurringExpense\Classes\Schedule as RecurringExpenseScheduleClass;

trait RecurringTrait
{
    public function propertiesOptions()
    {
        $txnRecurringDayOfMonth = [];
        $txnRecurringDayOfMonth[] = ['value' => '*', 'text' => 'Any Day' ];

        for ($i = 1; $i <= 31; $i++)
        {
            $txnRecurringDayOfMonth[] = ['value' => $i, 'text' => $i];
        }

        return [
            'frequency' => [
                [ 'value' => 'everyMinute', 'text' => 'Every Minute - repeat every minute' ],

                [ 'value' => 'monthly', 'text' => 'Monthly - repeat every month on this day' ],
                [ 'value' => 'hourly', 'text' => 'Hourly - repeat every hour of each day' ],
                [ 'value' => 'daily', 'text' => 'Daily - repeat everyday' ],
                [ 'value' => 'weekly', 'text' => 'Weekly - repeat every week on this day' ],
                [ 'value' => 'fortnight', 'text' => 'Fortnight - on this day' ],
                [ 'value' => '2months', 'text' => 'Every 2 Months - on this day' ],
                [ 'value' => '3months', 'text' => 'Every 3 Months - this day' ],
                [ 'value' => 'annually', 'text' => 'Annually - repeat every year on this month and day' ],
                [ 'value' => 'custom', 'text' => 'Custom - month, day of week & day of month to repeat' ],

                [ 'value' => 'everyTwoHours', 'text' => 'Repeat every two hours' ],
                [ 'value' => 'everyThreeHours', 'text' => 'Repeat every three hours' ],
                [ 'value' => 'everyFourHours', 'text' => 'Repeat every four hours' ],
                [ 'value' => 'everySixHours', 'text' => 'Repeat every six hours' ]
            ],
            'month' => [
                [ 'value' => '*', 'text' => 'Any month' ],
                [ 'value' => '1', 'text' => 'January' ],
                [ 'value' => '2', 'text' => 'February' ],
                [ 'value' => '3', 'text' => 'March' ],
                [ 'value' => '4', 'text' => 'April' ],
                [ 'value' => '5', 'text' => 'May' ],
                [ 'value' => '6', 'text' => 'June' ],
                [ 'value' => '7', 'text' => 'July' ],
                [ 'value' => '8', 'text' => 'August' ],
                [ 'value' => '9', 'text' => 'September' ],
                [ 'value' => '10', 'text' => 'October' ],
                [ 'value' => '11', 'text' => 'November' ],
                [ 'value' => '12', 'text' => 'December' ]
            ],
            'dayOfWeek' => [
                [ 'value' => '*', 'text' => 'Any day of the week' ],
                [ 'value' => '0', 'text' => 'Sunday' ],
                [ 'value' => '1', 'text' => 'Monday' ],
                [ 'value' => '2', 'text' => 'Tuesday' ],
                [ 'value' => '3', 'text' => 'Wednesday' ],
                [ 'value' => '4', 'text' => 'Thursday' ],
                [ 'value' => '5', 'text' => 'Friday' ],
                [ 'value' => '6', 'text' => 'Saturday' ]
            ],
            'dayOfMonth' => $txnRecurringDayOfMonth,
            'status' => [
                [ 'value' => 'active', 'text' => 'Active' ],
                [ 'value' => 'paused', 'text' => 'Paused' ],
                [ 'value' => 'de-active', 'text' => 'De-active' ],
            ]
        ];
    }
}
