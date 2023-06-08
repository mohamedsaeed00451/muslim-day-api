<?php

namespace App\Http\Controllers\Api\User\Prayers;

use App\Http\Controllers\Controller;
use App\Models\Prayers;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Http;

class PrayerController extends Controller
{
    use GeneralTrait;
    public function getPrayerTimes()
    {
        try {
            $response = Http::get('https://api.aladhan.com/v1/timingsByAddress/'.date('d-m-Y').'?address=Egypt,Africa&method=8');
            $data = $response->json();
            return $this->responseMessage(200, true, 'success',$data['data']);
        }catch (\Exception $e) {
            return $this->responseMessage(400, false, 'an error occurred');
        }
    }

    public function updatePrayerTimes()
    {
        try {

            $response = Http::get('https://api.aladhan.com/v1/timingsByAddress/'.date('d-m-Y').'?address=Egypt,Africa&method=8');
            $data['Fajr'] = $response['data']['timings']['Fajr'];
            $data['Dhuhr'] = $response['data']['timings']['Dhuhr'];
            $data['Asr'] = $response['data']['timings']['Asr'];
            $data['Maghrib'] = $response['data']['timings']['Maghrib'];
            $data['Isha'] = $response['data']['timings']['Isha'];

            foreach ($data as $type => $time) {
                Prayers::where('type',$type)->update(['time' => $time]);
            }
            //No Action
        }catch (\Exception $e) {
            //No Action
        }
    }
}
