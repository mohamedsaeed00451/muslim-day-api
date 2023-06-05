<?php

namespace Database\Seeders;

use App\Models\Reciter;
use App\Models\Surah;
use App\Models\SurahReciter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateSurahReciters extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      $surahs_ids = Surah::all()->pluck('id');
      $reciters_ids = Reciter::all()->pluck('id');

      foreach ($reciters_ids as $reciter_id) {
          foreach ($surahs_ids as $surah_id){
              SurahReciter::create([
                  'surah_id' => $surah_id,
                  'reciter_id' => $reciter_id
              ]);
          }
      }

    }
}
