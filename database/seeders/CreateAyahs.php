<?php

namespace Database\Seeders;

use App\Models\Ayah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CreateAyahs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->addAyahs();
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
                    if (is_array($sajda)) {
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
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
