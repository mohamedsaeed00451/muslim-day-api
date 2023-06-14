<?php

namespace Database\Seeders;

use App\Models\Audio;
use Illuminate\Database\Seeder;

class AddAudios extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i <= 114; $i++) {
            $number = str_pad($i, 3, '0', STR_PAD_LEFT);
            $file_name = $number .'.'. 'mp3';
            Audio::create([
                'surah_id' => $i,
                'reciter_id' => 12,
                'audio' => 'quran/al-kintawi/'.$file_name
            ]);
        }

    }
}
