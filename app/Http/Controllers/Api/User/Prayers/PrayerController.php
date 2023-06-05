<?php

namespace App\Http\Controllers\Api\User\Prayers;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Http;

class PrayerController extends Controller
{
    use GeneralTrait;
    public function getPrayerTimes()
    {
        try {
            $response = Http::get('https://api.aladhan.com/v1/timingsByAddress/'.date('d-m-Y').'?address=Saudi,AS&method=8');
            $data = $response->json();
            return $this->responseMessage(200, true, 'success',$data['data']);
        }catch (\Exception $e) {
            return $this->responseMessage(400, false, 'an error occurred');
        }
    }




}
