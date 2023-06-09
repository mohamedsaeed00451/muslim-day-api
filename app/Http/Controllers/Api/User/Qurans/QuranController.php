<?php

namespace App\Http\Controllers\Api\User\Qurans;

use App\Http\Controllers\Controller;
use App\Models\Audio;
use App\Models\Ayah;
use App\Models\Reciter;
use App\Models\Surah;
use App\Models\Video;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class QuranController extends Controller
{
    use GeneralTrait;

    public function getSurahs()
    {
        $surahs = Surah::select('id', 'name_' . app()->getLocale() . ' as name')->get();
        return $this->responseMessage(200, true, null, $surahs);
    }

    public function getAyahsSurah($id) // Surah id
    {
        $surah = Surah::find($id);
        if (!$surah)
            return $this->responseMessage(404, false, 'id not found');

        $ayahs = $surah->ayahs;
        return $this->responseMessage(200, true, 'success', $ayahs);
    }

    public function getTafsirSurah($id) // Surah id
    {
        $surah = Surah::find($id);
        if (!$surah)
            return $this->responseMessage(404, false, 'id not found');

        $tafsir = $surah->tafsirs;
        return $this->responseMessage(200, true, 'success', $tafsir);
    }

    public function getTafsirAyah($id) // Ayah id
    {
        $ayah = Ayah::find($id);
        if (!$ayah)
            return $this->responseMessage(404, false, 'id not found');

        $tafsir = $ayah->tafsir;
        return $this->responseMessage(200, true, 'success', $tafsir);
    }

    public function getReciters()
    {
        $reciters = Reciter::select('id', 'name_' . app()->getLocale() . ' as name', 'photo')->get();
        if (!$reciters)
            return $this->responseMessage(204, false, 'no data');

        foreach ($reciters as $reciter) {
            $photo_name = $reciter->photo;
            if ($photo_name != null) {
                $reciter->photo = $this->getPath('image_r', $photo_name);
            }
        }

        return $this->responseMessage(200, true, 'success', $reciters);
    }

    public function getReciterSurahs($id) // Reciter id
    {
        $reciter = Reciter::find($id);
        if (!$reciter)
            return $this->responseMessage(404, false, 'id not found');

        $surahs = $reciter->surahs()->select('surahs.id', 'name_' . app()->getLocale() . ' as name')->get();
        return $this->responseMessage(200, true, 'success', $surahs);
    }

    public function getSurahReciters($id) // Surah id
    {
        $surah = Surah::find($id);
        if (!$surah)
            return $this->responseMessage(404, false, 'id not found');

        $reciters = $surah->reciters()->select('reciters.id', 'name_' . app()->getLocale() . ' as name')->get();

        return $this->responseMessage(200, true, 'success', $reciters);
    }

    public function getSurahAudio(Request $request)
    {
        $rules = [
            'surah_id' => 'required|int|exists:surahs,id',
            'reciter_id' => 'required|int|exists:reciters,id',
        ];

        $validation = validator::make($request->all(), $rules);

        if ($validation->fails())
            return $this->responseMessage(400, false, $validation->messages());


        $audio = Audio::where('surah_id', $request->surah_id)
            ->where('reciter_id', $request->reciter_id)
            ->first();

        if (!$audio)
            return $this->responseMessage(400, false, 'no data');

        $audio->audio = $this->getPath('audios', $audio->audio); //get http path
        return $this->responseMessage(200, true, 'success', $audio);
    }

    public function getVideos()
    {
        try {
            $videos = Video::all();
            foreach ($videos as $video) {
                $video->video = $this->getPath('videos', $video->video);
            }
            return $this->responseMessage(200, true, 'success', $videos);
        } catch (\Exception $e) {
            return $this->responseMessage(400, false, $e->getMessage());
        }
    }

}
