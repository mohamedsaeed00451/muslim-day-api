<?php

namespace Database\Seeders;

use App\Models\Surah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CreateSurahs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->addSurahs();
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
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

}
