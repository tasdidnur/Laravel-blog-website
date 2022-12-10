<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $roles = [
            ['role_name'=>'Admin','role_slug'=>'admin','role_status'=>1,'created_at'=>Carbon::now()->toDateTimeString()],
            ['role_name'=>'Moderator','role_slug'=>'moderator','role_status'=>1,'created_at'=>Carbon::now()->toDateTimeString()],
            ['role_name'=>'Author','role_slug'=>'author','role_status'=>1,'created_at'=>Carbon::now()->toDateTimeString()],
        ];
        Role::insert($roles);
    }
}
