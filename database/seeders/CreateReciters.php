<?php

namespace Database\Seeders;

use App\Models\Reciter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateReciters extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reciters')->delete();
        $data = [

            [
                "name_ar" => "عبد الباسط بد الصمد",
                "name_en" => "Abdul Basit Abdul Samad"
            ],
            [
                "name_ar" => "محمود خليل الحصري",
                "name_en" => "Mahmoud Khalil Al-Hussary"
            ],
            [
                "name_ar" => "ياسر الدوسري",
                "name_en" => "Yasser Al-Dosari"
            ],
            [
                "name_ar" => "علي الحذيفي",
                "name_en" => "Ali Al-Hudhaifi"
            ],
            [
                "name_ar" => "أحمد خضر الطرابلسي",
                "name_en" => "Ahmed Khudairi Al-Tarabulsi"
            ],
            [
                "name_ar" => "عمر القزابري",
                "name_en" => "Omar Al-Qazabri"
            ],
            [
                "name_ar" => "أنس العمادي",
                "name_en" => "Anas Al-Emadi"
            ],
            [
                "name_ar" => "توفيق الصايغ",
                "name_en" => "Tawfeeq Al-Sayegh"
            ],
            [
                "name_ar" => "خليفة الطنيجي",
                "name_en" => "Khalifa Al-Tunaiji"
            ],
            [
                "name_ar" => "شيرزاد طاهر",
                "name_en" => "Sherzad Taher"
            ],
            [
                "name_ar" => "فؤاد الخامري",
                "name_en" => "Fouad Al-Khamiri"
            ],
            [
                "name_ar" => "محمد الكنتاوي",
                "name_en" => "Mohammed Al-Kintawi"
            ],
            [
                "name_ar" => "مشاري راشد العفاسي",
                "name_en" => "Mishari Rashid Al-Afasy"
            ],
            [
                "name_ar" => "حمزة الفار",
                "name_en" => "Hamza Al-Far"
            ]
        ];

        foreach ($data as $reciter) {
            Reciter::create($reciter);
        }
    }
}
