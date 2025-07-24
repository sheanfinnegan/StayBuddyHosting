<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class WaitingListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('waiting_lists')->insert([
            [
                'wlid' => 1,
                'homestay_id' => '4b5964f0f964a520fe8628e3',
                'created' => Carbon::now(),
                'remaining_time' => null,
                'done' => false,
            ],
            [
                'wlid' => 2,
                'homestay_id' => '4b5964f0f964a520fe8628e3',
                'created' => Carbon::now(),
                'remaining_time' => null,
                'done' => false,
            ]
        ]);

        // Insert Users
        
    }
}
