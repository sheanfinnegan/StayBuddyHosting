<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Shean Finneganr',
            'desc' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore
                            eveniet suscipit necessitatibus aliquam inventore ipsam, iusto ratione distinctio ab odio? Illum
                            quas accusamus dolorem modi consectetur, odit',
            
            'email' => 'sheanfinnegan2905@gmail.com',
            'phone_num' => '+62 81228831147',
            'bod' => '2005-09-29',
            'gender' => 'Male',
            'occupation' => 'Student',
            'password' => 'shean2909',
            'rating' => 5.0,
            'profile_picture' => 'assets/user/user-1.jpg'
        ]);

        DB::table('users')->insert([
            // Grup 1
            [
                'name' => 'Alice',
                'desc' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore
                            eveniet suscipit necessitatibus aliquam inventore ipsam, iusto ratione distinctio ab odio? Illum
                            quas accusamus dolorem modi consectetur, odit',
                'email' => 'alice@example.com',
                'phone_num' => '+62 81234567891',
                'bod' => '2000-01-01',
                'gender' => 'female',
                'email_verified_at' => now(),
                'password' => bcrypt('alice123'),
                'occupation' => 'Student',
                'wlid' => 1,
                'rating' => 4.9,
            'profile_picture' => 'assets/user/user-2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bob',
                'desc' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore
                            eveniet suscipit necessitatibus aliquam inventore ipsam, iusto ratione distinctio ab odio? Illum
                            quas accusamus dolorem modi consectetur, odit',
                'email' => 'bob@example.com',
                'phone_num' => '+62 81234567892',
                'bod' => '1999-05-10',
                'gender' => 'male',
                'email_verified_at' => now(),
                'password' => bcrypt('bob123'),
                'occupation' => 'Engineer',
                'wlid' => 1,
                'rating' => 4.5,
            'profile_picture' => 'assets/user/user-3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cathy',
                'desc' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore
                            eveniet suscipit necessitatibus aliquam inventore ipsam, iusto ratione distinctio ab odio? Illum
                            quas accusamus dolorem modi consectetur, odit',
                'email' => 'cathy@example.com',
                'phone_num' => '+62 81234567893',
                'bod' => '1998-08-20',
                'gender' => 'female',
                'email_verified_at' => now(),
                'password' => bcrypt('cathy123'),
                'occupation' => 'Designer',
                'wlid' => 1,
                'rating' => 4.0,
            'profile_picture' => 'assets/user/user-4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Grup 2
            [
                'name' => 'Dan',
                'desc' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore
                            eveniet suscipit necessitatibus aliquam inventore ipsam, iusto ratione distinctio ab odio? Illum
                            quas accusamus dolorem modi consectetur, odit',
                'email' => 'dan@example.com',
                'phone_num' => '+62 81234567894',
                'bod' => '2001-03-15',
                'gender' => 'male',
                'email_verified_at' => now(),
                'password' => bcrypt('dan123'),
                'occupation' => 'Developer',
                'wlid' => 2,
                'rating' => 4.7,
            'profile_picture' => 'assets/user/user-5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Eva',
                'desc' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore
                            eveniet suscipit necessitatibus aliquam inventore ipsam, iusto ratione distinctio ab odio? Illum
                            quas accusamus dolorem modi consectetur, odit',
                'email' => 'eva@example.com',
                'phone_num' => '+62 81234567895',
                'bod' => '2002-11-22',
                'gender' => 'female',
                'email_verified_at' => now(),
                'password' => bcrypt('eva123'),
                'occupation' => 'Doctor',
                'wlid' => 2,
                'rating' => 5.0,
            'profile_picture' => 'assets/user/user-6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Belum tergabung
            [
                'name' => 'Frank',
                'desc' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore
                            eveniet suscipit necessitatibus aliquam inventore ipsam, iusto ratione distinctio ab odio? Illum
                            quas accusamus dolorem modi consectetur, odit',
                'email' => 'frank@example.com',
                'phone_num' => '+62 81234567896',
                'bod' => '2000-12-12',
                'gender' => 'male',
                'email_verified_at' => now(),
                'password' => bcrypt('frank123'),
                'occupation' => 'Lawyer',
                'wlid' => null,
                'rating' => 3.9,
            'profile_picture' => 'assets/user/user-7.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
