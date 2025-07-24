<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('questions')->insert([
            [
                'question_text' => 'Apakah Anda keberatan dengan teman yang merokok?',
                'option_1' => 'Sangat Keberatan',
                'option_2' => 'Keberatan',
                'option_3' => 'Biasa saja',
                'option_4' => 'Lumayan Keberatan',
                'option_5' =>'Tidak Keberatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'Apakah Anda keberatan dengan teman yang alcoholic?',
                'option_1' => 'Sangat Keberatan',
                'option_2' => 'Keberatan',
                'option_3' => 'Biasa saja',
                'option_4' => 'Lumayan Keberatan',
                'option_5' => 'Tidak Keberatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'Tingkat kebersihan ruangan Anda',
                'option_1' => 'Sangat Berantakan',
                'option_2' => 'Berantakan',
                'option_3' => 'Biasa saja',
                'option_4' => 'Rapih',
                'option_5' => 'Sangat Rapih',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'Preferensi umur teman serumah Anda',
                'option_1' => 'Bebas',
                'option_2' => 'Rentang umur yang sama',
                'option_3' => null, // Tambahkan ini
    'option_4' => null, // Tambahkan ini
    'option_5' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'Tipe rutinitas harian harian Anda',
                'option_1' => 'Morning person (segar dan produktif di pagi hari.)',
                'option_2' => 'Night owl (segar dan produktif di malam hari)',
                'option_3' => 'Fleksibel',// Tambahkan ini
    'option_4' => null, // Tambahkan ini
    'option_5' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'Pereferensi tipe kamar Anda?',
                'option_1' => 'Sharing (satu ruangan lebih dari satu orang)',
                'option_2' => 'Sendirian',
                'option_3' => null, // Tambahkan ini
    'option_4' => null, // Tambahkan ini
    'option_5' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'Seberapa aktif Anda bersosialisasi dengan teman?',
                'option_1' => 'Sangat pendiam',
                'option_2' => 'Cenderung pendiam',
                'option_3' => 'Biasa saja',
                'option_4' => 'Aktif',
                'option_5' => 'Sangat Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'Seberapa sering Anda memasak untuk makan sehari-hari?',
                'option_1' => 'Tidak pernah masak',
                'option_2' => 'Jarang masak',
                'option_3' => 'Kadang-kadang',
                'option_4' => 'Sering masak',
                'option_5' => 'Sangat sering masak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'Berapa suhu ruangan ternyaman Anda?',
                'option_1' => '20°C - 24°C',
                'option_2' => '16°C - 20°C',
                'option_3' => '22°C - 26°C', // Tambahkan ini
    'option_4' => null, // Tambahkan ini
    'option_5' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'Bagaimana kondisi ternyaman Anda saat bekerja/belajar di rumah',
                'option_1' => 'Sunyi atau diam',
                'option_2' => 'Ada sedikit suara',
                'option_3' => 'Berisik atau bising',
    'option_4' => null, // Tambahkan ini
    'option_5' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'Bagaimana toleransi Anda terhadap kebisingan?',
                'option_1' => 'Sangat terganggu',
                'option_2' => 'Terganggu',
                'option_3' => 'Biasa saja',
                'option_4' => 'Tidak terganggu',
                'option_5' =>'Sangat tidak terganggu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'Genre Musik yang Anda dengarkan sehari-hari',
                'option_1' => 'Jazz',
                'option_2' => 'Pop',
                'option_3' => 'Rock',
                'option_4' => 'Other',
    'option_5' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
