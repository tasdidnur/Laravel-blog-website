<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        User::insert([
            'name' => 'Tasdid',
            'phone' => '0123456789',
            'email' => 'demo@gmail.com',
            'password' => Hash::make('12345678'),
            'role' =>1,
            'created_at' => Carbon::now()->toDateTimeString(),
         ]);
    }
}
