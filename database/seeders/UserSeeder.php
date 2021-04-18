<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'mobile' => '9593352880',
                'username' => 'admin',
                'is_admin' => 1,
                'user_type' => 'Admin', 
                'email_verified_at' => now(),
                'password' => Hash::make('1qaz2wsx'),
            ],[
                'name' => 'User',
                'email' => 'user@mail.com',
                'mobile' => '9593352881',
                'username' => 'user',
                'is_admin' => 0,
                'user_type' => 'Student', 
                'email_verified_at' => now(),
                'password' => Hash::make('1qaz2wsx'),
            ]
        ]);

        User::factory()->count(98)->create();
    }
}