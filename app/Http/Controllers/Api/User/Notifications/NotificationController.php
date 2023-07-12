<?php

namespace App\Http\Controllers\Api\User\Notifications;

use App\Http\Controllers\Controller;
use App\Models\Prayers;
use App\Traits\GeneralTrait;
use Carbon\Carbon;

class NotificationController extends Controller
{
    use GeneralTrait;

    public function NotificationNextPrayer() //Send Notification Next Prayer To All Devices
    {
        try {

//           // https://ia803007.us.archive.org/31/items/nice_tone/nice_tone.mp3
//          return $this->sendNotifications('تحية خاصة لمرسى', 'احلى مسا عليك', 'https://ia803006.us.archive.org/7/items/stone_201906/stone.mp3');
//           // return $this->getPath('audios','notification/prayer.mp3');

            $currentTime = Carbon::now();
            $currentTime = Carbon::parse($currentTime)->addMinute(10);
            $currentTime = $currentTime->format('H:i');

            $prayer = Prayers::where('time', $currentTime)->first();

            if (!empty($prayer)) {
                $this->sendNotifications('إقترب موعد الصلاة', 'إن الصلاة كانت على المؤمنين كتابا موقوتا', $this->getPath('audios','notification/prayer.mp3'));
            }

        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationDuhaPrayer() //Send Notification Duha Prayer To All Devices
    {
        try {
            $this->sendNotifications('تنبية لصلاة الضحى', 'موعد صلاة الضحى الان', $this->getPath('audios','notification/prayer.mp3'));
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationRamadanPreviousDay()
    {
        try {
            $ramadanPreviousDay = $this->getRamadanPreviousDay();
            if ($ramadanPreviousDay) {
                $this->sendNotifications('تنبية لقدوم شهر رمضان', 'اللهم بلغنا رمضان', $this->getPath('audios','notification/ramadan.mp3'));
            }
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationRamadanFirstDay()
    {
        try {
            $RamadanFirstDay = $this->getRamadanFirstDay();
            if ($RamadanFirstDay) {
                $this->sendNotifications('تنبية اول ايام رمضان', 'اول يوم فى الشهر الكريم اعادة الله علينا وعليكم بالخير واليمن والبركات', $this->getPath('audios','notification/ramadan.mp3'));
            }
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationEidAlFitr()
    {
        try {
            $EidAlFitr = $this->getEidAlFitr();
            if ($EidAlFitr) {
                $this->sendNotifications('تنبية عيد الفطر', 'كل عام وانتم بخير بمناسبة غيد الفطر المبارك', $this->getPath('audios','notification/eid.mp3'));
            }
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationEidAlAdha()
    {
        try {
            $EidAlAdha = $this->getEidAlAdha();
            if ($EidAlAdha) {
                $this->sendNotifications('تنبية عيد الاضحى', 'كل عام وانتم بخير بمناسبة غيد الاضحى المبارك', $this->getPath('audios','notification/eid.mp3'));
            }
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationArafatDay()
    {
        try {
            $ArafatDay = $this->getArafatDay();
            if ($ArafatDay) {
                $this->sendNotifications('تنبية يوم عرفة', 'نوصيكم بصيام يوم عرفة', $this->getPath('audios','notification/all.mp3'));
            }
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationDhulHujjahFastingDays()
    {
        try {
            $DhulHujjahFastingDays = $this->getDhulHujjahFastingDays();
            if ($DhulHujjahFastingDays) {
                $this->sendNotifications('تنبية ذو الحجة', 'نوصيكم بصيام عشر ايام من ذو الحجة', $this->getPath('audios','notification/all.mp3'));
            }
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationAshuraFastingDays()
    {
        try {
            $AshuraFastingDays = $this->getAshuraFastingDays();
            if ($AshuraFastingDays) {
                $this->sendNotifications('تنبية عاشورة', 'نوصيكم بصيام يومى التاسع والعاشر من شهر عاشورة', $this->getPath('audios','notification/all.mp3'));
            }
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationWhiteDaysFastingDays()
    {
        try {
            $WhiteDaysFastingDays = $this->getWhiteDaysFastingDays();
            if ($WhiteDaysFastingDays) {
                $this->sendNotifications('تنبية صيام الايام البيض من كل شهر هجرى', 'نوصيكم بصيام ايام الثالث عشر والرابع عشر والخامس عشر من كل شهر هجرى', $this->getPath('audios','notification/all.mp3'));
            }
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationSixDaysOfShawwalFastingDays()
    {
        try {
            $SixDaysOfShawwalFastingDays = $this->getSixDaysOfShawwalFastingDays();
            if ($SixDaysOfShawwalFastingDays) {
                $this->sendNotifications('تنبية صيام شوال', 'نوصيكم بصيام ستة ايام من شهر شوال', $this->getPath('audios','notification/all.mp3'));
            }
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationMondayAndThursdayFastingDays()
    {
        try {
            $this->sendNotifications('تنبية صيام يومى الاثنين والخميس', 'نوصيكم بصيام يومى الاثنين والخميس من كل شهر', $this->getPath('audios','notification/all.mp3'));
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationMorning()
    {
        try {
            $this->sendNotifications('تنبية لأذكار الصباح', 'نوصيكم بتادية أذكار الصباح', $this->getPath('audios','notification/morning.mp3'));
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationEvening()
    {
        try {
            $this->sendNotifications('تنبية لأذكار المساء', 'نوصيكم بتادية أذكار المساء', $this->getPath('audios','notification/evening.mp3'));
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationPrayerNapyMohamed()
    {
        try {
            $this->sendNotifications('تنبية للصلاة على النبى', 'صلى على محمد علية الصلاة والسلام', $this->getPath('audios','notification/napy-prayer.mp3'));
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationTasbih()
    {
        try {
            $this->sendNotifications('تنبية للتسبيح', 'سبحان الله وبحمدة سبحان اللة العظيم', $this->getPath('audios','notification/tasbih.mp3'));
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationSeekingForgivenness()
    {
        try {
            $this->sendNotifications('تنبية للاستغفار', 'استغفر الله العظيم رب العرش العظيم واتوب ايه', $this->getPath('audios','notification/seeking.mp3'));
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationExpressingGratitude()
    {
        try {
            $this->sendNotifications('تنبية للحمد', 'الحمد لله رب العلمين', $this->getPath('audios','notification/expressing.mp3'));
        } catch (\Exception $e) {
            //No Action
        }
    }

    public function NotificationNightPrayer()
    {
        try {
            $this->sendNotifications('تنبية لقيام الليل', 'نوصيكم بقيام الليل', $this->getPath('audios','notification/night-prayer.mp3'));
        } catch (\Exception $e) {
            //No Action
        }
    }

}
