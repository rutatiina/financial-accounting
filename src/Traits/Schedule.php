<?php

namespace Rutatiina\FinancialAccounting\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Rutatiina\Invoice\Services\RecurringInvoiceScheduleService;
use Rutatiina\Bill\Services\RecurringBillScheduleService;
use Rutatiina\Expense\Services\RecurringExpenseSheduleService;

trait Schedule
{
    /**
     * Execute the console command.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @param  Model  $tasks
     * @return boolean
     */
    public function recurringSchedule($schedule, $tasks)
    {
        //return true;

        config(['app.scheduled_process' => true]);

        //$schedule->call(function () {
        //    Log::info('recurringInvoiceSchedule via trait has been called #updated');
        //})->everyMinute()->runInBackground();

        //the script to process recurring requests

        //Log::info('number of tasks: '.$tasks->count());

        foreach ($tasks as $task)
        {
            $timeZone = ($task->tenant->time_zone) ? $task->tenant->time_zone : 'UTC';
            $frequency = $task->frequency;

            config(['app.tenant_id' => $task->tenant_id]); //set the tenantId which will be used by the scope

            //> dynamically change the time zone being used
            config(['app.timezone' => $timeZone]);
            date_default_timezone_set($timeZone);
            //< dynamically change the time zone being used

            $tasDayOfWeekNumber = date('N', strtotime($task->created_by)); // N - ISO-8601 numeric representation of the day of the week	1 (for Monday) through 7 (for Sunday)
            $tasDayOfMonthNumber = date('j', strtotime($task->created_by)); // j - Day of the month without leading zeros	1 to 31
            $tasMonthNumber = date('n', strtotime($task->created_by)); // n - Numeric representation of a month, without leading zeros	1 through 12

            if ($task instanceof \Rutatiina\Invoice\Models\RecurringInvoice)
            {
                $call = new RecurringInvoiceScheduleService($task);
                //Log::info('This is an instanceof \Rutatiina\RecurringInvoice\Models\RecurringInvoice');
            }
            elseif ($task instanceof \Rutatiina\Expense\Models\RecurringExpense)
            {
                $call = new RecurringExpenseSheduleService($task);
                //Log::info('This is an instanceof \Rutatiina\RecurringExpense\Models\RecurringExpense');
            }
            elseif ($task instanceof \Rutatiina\Bill\Models\RecurringBill)
            {
                $call = new RecurringBillScheduleService($task);
                //Log::info('This is an instanceof \Rutatiina\RecurringBill\Models\RecurringBill');
            }
            else
            {
                $call = ''; //Invalid scheduled callback event. Must be a string or callable
                //Log::info('This is NOT an instanceof Invoice, Bill, Expense Recurring Model');
            }

            switch ($frequency)
            {
                case "fortnight":

                    //Fortnight - repeat every after two weeks on this day
                    $schedule->call($call)
                        ->weeklyOn($tasDayOfWeekNumber, '00:00')->when(function() use ($task) {

                            $carbonLatRun = Carbon::parse($task->last_run);
                            $carbonNow = Carbon::now();
                            $days =  $carbonLatRun->diffInDays($carbonNow);

                            return ($days == 14);
                        })
                        ->timezone($timeZone);

                    break;

                case "weekly":

                    $schedule->call($call)
                        ->weeklyOn($tasDayOfWeekNumber, '00:00')
                        ->timezone($timeZone);

                    break;

                case "2months":

                    $schedule->call($call)
                        ->monthlyOn($tasDayOfWeekNumber, '00:00')->when(function() use ($task) {

                            $carbonLatRun = Carbon::parse($task->last_run);
                            $carbonNow = Carbon::now();
                            $nextRunDate =  $carbonLatRun->addMonths(2);

                            //return ($carbonNow == $nextRunDate);
                            return $carbonNow->isSameDay($nextRunDate);
                        })
                        ->timezone($timeZone);

                    break;

                case "3months":

                    $schedule->call($call)
                        ->monthlyOn($tasDayOfWeekNumber, '00:00')->when(function() use ($task) {

                            $carbonLatRun = Carbon::parse($task->last_run);
                            $carbonNow = Carbon::now();
                            $nextRunDate =  $carbonLatRun->addMonths(3);

                            //return ($carbonNow == $nextRunDate);
                            return $carbonNow->isSameDay($nextRunDate);
                        })
                        ->timezone($timeZone);

                    break;

                case "annually":

                    $schedule->call($call)
                        ->yearlyOn($tasMonthNumber, $tasDayOfMonthNumber, '00:00')->when(function() use ($task) {

                            $carbonLatRun = Carbon::parse($task->last_run);
                            $carbonNow = Carbon::now();
                            $nextRunDate =  $carbonLatRun->addYear();

                            //return ($carbonNow == $nextRunDate);
                            return $carbonNow->isSameDay($nextRunDate);
                        })
                        ->timezone($timeZone);

                    break;

                case "custom":

                    /*
                     *
                     * Minute(0-59) Hour(0-24) Day_of_month(1-31) Month(1-12) Day_of_week(0-6) Command_to_execute
                     *
                     * # ┌───────────── minute (0 - 59)
                     * # │ ┌───────────── hour (0 - 23)
                     * # │ │ ┌───────────── day of the month (1 - 31)
                     * # │ │ │ ┌───────────── month (1 - 12)
                     * # │ │ │ │ ┌───────────── day of the week (0 - 6) (Sunday to Saturday;
                     * # │ │ │ │ │                                   7 is also Sunday on some systems)
                     * # │ │ │ │ │
                     * # │ │ │ │ │
                     * # * * * * * <command to execute>
                     *
                     */

                    $cronJobFormat = '0 0 '.$task->day_of_month.' '.$task->month.' '.$task->day_of_week;

                    $schedule->call($call)
                        ->cron($cronJobFormat)
                        ->timezone($timeZone);
                    break;

                case 23:
                    echo "i equals 2";
                    break;

                default:
                    $schedule->call($call)
                        ->$frequency()
                        ->timezone($timeZone);
            }
        }

        return true;
    }
}
