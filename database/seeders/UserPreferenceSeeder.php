<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $smokingOptions = ['Sangat Keberatan', 'Keberatan', 'Biasa saja', 'Lumayan Keberatan', 'Tidak Keberatan'];
        $alcoholicOptions = $smokingOptions;
        $tidinessOptions = [1, 2, 3, 4, 5]; // Angka sesuai tingkat
        $preferedAgeOptions = ['Bebas', 'Rentang umur yang sama'];
        $routineTypeOptions = ['Morning person (segar dan produktif di pagi hari.)', 'Night owl (segar dan produktif di malam hari)', 'Fleksibel'];
        $roomTypeOptions = ['Sharing (satu ruangan lebih dari satu orang)', 'Sendirian'];
        $socializingOptions = [1, 2, 3, 4, 5];
        $cookingFreqOptions = [1, 2, 3, 4, 5];
        $roomTemperatureOptions = ['20°C - 24°C', '16°C - 20°C', '22°C - 26°C'];
        $workTypeOptions = ['Sunyi atau diam', 'Ada sedikit suara', 'Berisik atau bising'];
        $noiseToleranceOptions = [1, 2, 3, 4, 5];
        $musicGenreOptions = ['Jazz', 'Pop', 'Rock', 'Other'];

        for ($i = 1; $i <= 7; $i++) {
            DB::table('user_preferences')->insert([
                'user_id' => $i,
                'smoking' => fake()->randomElement($smokingOptions),
                'alcoholic' => fake()->randomElement($alcoholicOptions),
                'tidiness' => fake()->randomElement($tidinessOptions),
                'prefered_age' => fake()->randomElement($preferedAgeOptions),
                'routine_type' => fake()->randomElement($routineTypeOptions),
                'room_type' => fake()->randomElement($roomTypeOptions),
                'socializing' => fake()->randomElement($socializingOptions),
                'cooking_freq' => fake()->randomElement($cookingFreqOptions),
                'room_temperature' => fake()->randomElement($roomTemperatureOptions),
                'work_type' => fake()->randomElement($workTypeOptions),
                'noise_tolerance' => fake()->randomElement($noiseToleranceOptions),
                'music_genre' => fake()->randomElement($musicGenreOptions),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
