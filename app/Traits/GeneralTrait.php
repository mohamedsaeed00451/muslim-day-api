<?php

namespace App\Traits;

use Alkoumi\LaravelHijriDate\Hijri;

trait GeneralTrait
{

    public function responseMessage($code,$Status,$Message = null ,$data = null)
    {
        return response()->json([
            'code' => $code,
            'status' => $Status,
            'message' => $Message,
            'data' => $data
        ]);
    }

	public function getPath($type,$name)
	{
		if ($type == 'image_r') {
			$path = 'images/reciters/'.$name;
		}

		if ($type == 'image_u') {
			$path = 'images/users/'.$name;
		}

		if ($type == 'audios') {
			$path = 'audios/'.$name;
		}

		if ($type == 'videos') {
			$path = 'videos/'.$name;
		}

		$url = url('/public/uploads/'.$path);

		return $url;
	}

    public function getRamadan()
    {
        $month = Hijri::Date('m');
        if ($month == '09')
            return true;
        return false;
    }

    public function getRamadanFirstDay()
    {
        $month = Hijri::Date('m');
        $day = Hijri::Date('j');
        if ($month == '09' && $day == '01')
            return true;
        return false;
    }

    public function getRamadanPreviousDay()
    {
        $month = Hijri::Date('m');
        $day = Hijri::Date('j');
        if ($month == '08' && $day >= '30')
            return true;
        return false;
    }

    public function getEidAlFitr()
    {
        $month = Hijri::Date('m');
        $day = Hijri::Date('j');
        if ($month == '10') {
            if (in_array($day, ['01', '02', '03', '04'])) {
                return true;
            }
        }
        return false;
    }

    public function getEidAlAdha()
    {
        $month = Hijri::Date('m');
        $day = Hijri::Date('j');
        if ($month == '12') {
            if (in_array($day, ['10', '11', '12', '13'])) {
                return true;
            }
        }
        return false;
    }

    public function getArafatDay()
    {
        $month = Hijri::Date('m');
        $day = Hijri::Date('j');
        if ($month == '12' && $day == '09')
            return true;

        return false;
    }

    public function getDhulHujjahFastingDays()
    {
        $month = Hijri::Date('m');
        $day = Hijri::Date('j');
        if ($month == '12' && $day == '1') {
            return true;
        }
        return false;
    }

    public function getAshuraFastingDays()
    {
        $month = Hijri::Date('m');
        $day = Hijri::Date('j');
        if ($month == '01') {
            if (in_array($day, ['09', '10']))
                return true;
        }
        return false;
    }

    public function getWhiteDaysFastingDays()
    {
        $day = Hijri::Date('j');
        if (in_array($day, ['13', '14', '15']))
            return true;

        return false;
    }

    public function getSixDaysOfShawwalFastingDays()
    {
        $month = Hijri::Date('m');
        $day = Hijri::Date('j');
        if ($month == '10' && $day == '01')
            return true;

        return false;
    }

    public function getMondayAndThursdayFastingDays()
    {
        $dayName = Hijri::Date('l');
        if ($dayName == 'الخميس' || $dayName == 'الأثنين')
            return true;
        return false;
    }

}

/*
    // Choose Your Format Like 'l ، j F ، Y'
    // l => اليوم [الجمعة]
    // j => تاريخ اليوم الهجري [27]
    // m => رقم الشهر االهجري [09]
    // F => اسم الشهر الهجري [رمضان]
    // Y => السنة بالتاريخ الهجري [1442]
    // a => 'ص'
    // A => 'صباحًا'
    // H => الساعات
    // i => الدقائق
    // s => الثواني

    use Alkoumi\LaravelHijriDate\Hijri;

    Hijri::Date('l ، j F ، Y');                         // Without Defining Timestamp It will return Hijri Date of [NOW]  => Results "الجمعة ، 12 ربيع الآخر ، 1442"
    Hijri::Date('Y/m/d');                              // => Results "1442/04/12"
    Hijri::DateIndicDigits('l ، j F ، Y');              // Without Defining Timestamp It will return Hijri Date of [NOW] in Indic Digits => Results "الجمعة ، ١٢ ربيع الآخر ، ١٤٤٢"
    Hijri::DateIndicDigits('Y/m/d');                   //  => Results "١٤٤٢/٠٤/١٢"

[OR]

    $date = Carbon::now()->addMonth();
    Hijri::Date('l ، j F ، Y', $date);                  // With optional Timestamp It will return Hijri Date of [$date] => Results "الأحد ، 12 جمادى الأول ، 1442"
    Hijri::Date('Y/m/d');                              // => Results "1442/04/12"
    Hijri::DateIndicDigits('l ، j F ، Y', $date);       // With optional Timestamp It will return Hijri Date of [$date] in Indic Digits => Results "الأحد ، ١٢ جمادى الأول ، ١٤٤٢"
    Hijri::DateIndicDigits('Y/m/d');                   //  => Results "١٤٤٢/٠٤/١٢"



    use Alkoumi\LaravelHijriDate\Hijri;

    Hijri::ShortDate();                 // Without Defining Timestamp It will return Hijri Date of [NOW] => Results "1442/04/12"
    Hijri::ShortDateIndicDigits();      // Without Defining Timestamp It will return Hijri Date of [NOW] in Indic Digits => Results "١٤٤٢/٠٤/١٢"

    [OR]

    $date = Carbon::now()->addMonth();
    Hijri::ShortDate($date);                 // With optional Timestamp It will return Hijri Date of [$date] => Results "1442/05/12"
    Hijri::ShortDateIndicDigits($date);      // With optional Timestamp It will return Hijri Date of [$date] in Indic Digits => Results "١٤٤٢/٠٥/١٢"


    use Alkoumi\LaravelHijriDate\Hijri;

    Hijri::MediumDate();                    // Without Defining Timestamp It will return Hijri Date of [NOW] => Results "الجمعة ، 12 ربيع الآخر ، 1442"
    Hijri::MediumDateIndicDigits();         // Without Defining Timestamp It will return Hijri Date of [NOW] in Indic Digits => Results "الجمعة ، ١٢ ربيع الآخر ، ١٤٤٢"

    [OR]

    $date = Carbon::now()->addMonth();
    Hijri::MediumDate($date);                 // With optional Timestamp It will return Hijri Date of [$date] => Results "الأحد ، 12 جمادى الأول ، 1442"
    Hijri::MediumDateIndicDigits($date);      // With optional Timestamp It will return Hijri Date of [$date] in Indic Digits => Results "الأحد ، ١٢ جمادى الأول ، ١٤٤٢"


    use Alkoumi\LaravelHijriDate\Hijri;

    Hijri::FullDate();                    // Without Defining Timestamp It will return Hijri Date of [NOW] => Results "الجمعة ، 12 ربيع الآخر ، 1442 - 12:34:25 مساءً"
    Hijri::FullDateIndicDigits();         // Without Defining Timestamp It will return Hijri Date of [NOW] in Indic Digits => Results "الجمعة ، ١٢ ربيع الآخر ، ١٤٤٢ - ١٢:٣٤:٢٥ مساءً"

    [OR]

    $date = Carbon::now()->addMonth();
    Hijri::FullDate($date);                 // With optional Timestamp It will return Hijri Date of [$date] => Results "الأحد ، 12 جمادى الأول ، 1442 - 12:34:25 مساءً"
    Hijri::FullDateIndicDigits($date);      // With optional Timestamp It will return Hijri Date of [$date] in Indic Digits => Results "الأحد ، ١٢ جمادى الأول ، ١٤٤٢ - ١٢:٣٤:٢٥ مساءً"

*/
