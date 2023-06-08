<?php

namespace App\Console;

use App\Http\Controllers\Api\User\Notifications\NotificationController;
use App\Http\Controllers\Api\User\Prayers\PrayerController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        //***************** Clear Old OTP Table *******************//
        $schedule->command('otp:clean')->daily();

        //**************** Update Prayers Times *********************//
        $schedule->call(function () {
            $PrayerController = new PrayerController();
            $PrayerController->updatePrayerTimes();
        })->dailyAt('00:00');

        //**************** Notification After 7 min Prayers  *********************//
        $schedule->call(function () {
            $NotificationController = new NotificationController();
            $NotificationController->NotificationNextPrayer();
        })->everyMinute();


        $schedule->call(function () {
            $NotificationController = new NotificationController();

            //**************** Notification Ramadan Previous Day  *********************//
            $NotificationController->NotificationRamadanPreviousDay();
            //**************** Notification Ramadan First Day  *********************//
            $NotificationController->NotificationRamadanFirstDay();
            //**************** Notification Eid Al-Fitr  *********************//
            $NotificationController->NotificationEidAlFitr();
            //**************** Notification Eid Al-Adha  *********************//
            $NotificationController->NotificationEidAlAdha();

        })->dailyAt('08:00');


        $schedule->call(function () {
            $NotificationController = new NotificationController();

            //**************** Notification Arafat Day  *********************//
            $NotificationController->NotificationArafatDay();
            //**************** Notification Dhul-Hujjah Fasting Days  *********************//
            $NotificationController->NotificationDhulHujjahFastingDays();
            //**************** Notification Ashura Fasting Days  *********************//
            $NotificationController->NotificationAshuraFastingDays();
            //**************** Notification White Days Fasting Days  *********************//
            $NotificationController->NotificationWhiteDaysFastingDays();
            //**************** Notification Six Days Of Shawwal Fasting Days  *********************//
            $NotificationController->NotificationSixDaysOfShawwalFastingDays();

        })->dailyAt('23:00');


        $schedule->call(function () {
            $NotificationController = new NotificationController();
            //**************** Notification Monday And Thursday Fasting Days  *********************//
            $NotificationController->NotificationMondayAndThursdayFastingDays();
        })->sundays()->wednesdays()->dailyAt('23:00');


        $schedule->call(function () {
            $NotificationController = new NotificationController();
            //**************** Notification Morning  *********************//
            $NotificationController->NotificationMorning();
        })->dailyAt('08:00');


        $schedule->call(function () {
            $NotificationController = new NotificationController();
            //**************** Notification Evening  *********************//
            $NotificationController->NotificationEvening();
        })->dailyAt('20:00');


        $schedule->call(function () {
            $NotificationController = new NotificationController();
            //**************** Notification Prayer Napy Mohamed  *********************//
            $NotificationController->NotificationPrayerNapyMohamed();
        })->everyTenMinutes();


        $schedule->call(function () {
            $NotificationController = new NotificationController();
            //**************** Notification Tasbih  *********************//
            $NotificationController->NotificationTasbih();
        })->everySixHours();


        $schedule->call(function () {
            $NotificationController = new NotificationController();
            //**************** Notification Seeking Forgivenness  *********************//
            $NotificationController->NotificationSeekingForgivenness();
        })->everyTwoHours();


        $schedule->call(function () {
            $NotificationController = new NotificationController();
            //**************** Notification Expressing Gratitude  *********************//
            $NotificationController->NotificationExpressingGratitude();
        })->everyOddHour();


        $schedule->call(function () {
            $NotificationController = new NotificationController();
            //**************** Notification Night Prayer  *********************//
            $NotificationController->NotificationNightPrayer();
        })->dailyAt('00:00');


        $schedule->call(function () {
            $NotificationController = new NotificationController();
            //**************** Notification Duha Prayer  *********************//
            $NotificationController->NotificationDuhaPrayer();
        })->dailyAt('11:30');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
