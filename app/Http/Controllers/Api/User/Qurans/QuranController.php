<?php

namespace App\Http\Controllers\Api\User\Qurans;

use App\Http\Controllers\Controller;
use App\Models\Ayah;
use App\Models\Surah;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Http;

class QuranController extends Controller
{
    use GeneralTrait;
    public function getSurahs()
    {
        $surahs = Surah::select('id','name_'.app()->getLocale() .' as name')->get();
        return $this->responseMessage(200,true,null,$surahs);
    }
    public function getAyahsSurah($id)
    {
        $surah = Surah::find($id);
        if (!$surah) {
            return $this->responseMessage(404,false,'id not found');
        }
        $ayahs = $surah->ayahs;
        return $this->responseMessage(200,true,'success',$ayahs);
    }

    public function addSurahs()
    {
        try {
            $response = Http::get('https://api.alquran.cloud/v1/quran/quran-uthmani');
            $data = $response->json();

            $new_data = $data['data']['surahs'];
            foreach ($new_data as $one) {

                Surah::create([
                    'name_ar' => $one['name'],
                    'name_en' => $one['englishName']
                ]);

            }
            return 'ok';
        }catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function addAyahs()
    {
        try {
            $response = Http::get('https://api.alquran.cloud/v1/quran/quran-uthmani');
            $data = $response->json();

            $new_data = $data['data']['surahs'];
            foreach ($new_data as $one) {
                $surahNumber = $one['number'];
                foreach ($one['ayahs'] as $o) {

                    $ayahNumberInSursh = $o['numberInSurah'];
                    $text = $o['text'];
                    $juz = $o['juz'];
                    $manzil = $o['manzil'];
                    $page = $o['page'];
                    $ruku = $o['ruku'];
                    $hizbQuarter = $o['hizbQuarter'];
                    $sajda = $o['sajda'];
                    if (is_array($sajda)){
                        $sajda = true;
                    }

                    Ayah::create([
                        'text' => $text,
                        'juz' => $juz,
                        'manzil' => $manzil,
                        'page' => $page,
                        'ruku' => $ruku,
                        'hizbQuarter' => $hizbQuarter,
                        'sajda' => $sajda,
                        'surah_id' => $surahNumber,
                        'number_in_surah' => $ayahNumberInSursh
                    ]);
                }
            }
            return 'ok';
        }catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
