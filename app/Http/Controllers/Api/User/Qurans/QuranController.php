<?php

namespace App\Http\Controllers\Api\User\Qurans;

use App\Http\Controllers\Controller;
use App\Models\Ayah;
use App\Models\Reciter;
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
    public function getAyahsSurah($id) // Surah id
    {
        $surah = Surah::find($id);
        if (!$surah)
            return $this->responseMessage(404,false,'id not found');

        $ayahs = $surah->ayahs;
        return $this->responseMessage(200,true,'success',$ayahs);
    }

    public function getTafsirSurah($id) // Surah id
    {
        $surah = Surah::find($id);
        if (!$surah)
            return $this->responseMessage(404,false,'id not found');

        $tafsir = $surah->tafsirs;
        return $this->responseMessage(200,true,'success',$tafsir);
    }

    public function getTafsirAyah($id) // Ayah id
    {
        $ayah = Ayah::find($id);
        if (!$ayah)
            return $this->responseMessage(404,false,'id not found');

        $tafsir = $ayah->tafsir;
        return $this->responseMessage(200,true,'success',$tafsir);
    }

    public function getReciters()
    {
        $reciters = Reciter::select('id','name_'.app()->getLocale() . ' as name','photo')->get();
        if (!$reciters)
            return $this->responseMessage(204,false,'no data');

        foreach ($reciters as $reciter) {
            $photo_name = $reciter->photo;
            if ($photo_name != null) {
                $reciter->photo = $this->getPath('image_r',$photo_name);
            }
        }

        return $this->responseMessage(200,true,'success',$reciters);
    }

    public function getReciterSurahs($id) // Reciter id
    {
        $reciter = Reciter::find($id);
        if (!$reciter)
            return $this->responseMessage(404,false,'id not found');

        $surahs = $reciter->surahs()->select('surahs.id','name_'.app()->getLocale().' as name')->get();
        return $this->responseMessage(200,true,'success',$surahs);
    }

    public function getSurahReciters($id) // Surah id
    {
        $surah = Surah::find($id);
        if (!$surah)
            return $this->responseMessage(404,false,'id not found');

        $reciters = $surah->reciters()->select('reciters.id','name_'.app()->getLocale().' as name')->get();

        return $this->responseMessage(200,true,'success',$reciters);
    }











    //************************************ store ***************************************//

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
