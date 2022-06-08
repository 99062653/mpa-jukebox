<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    //php artisan db:seed --class=RoleSeeder
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'user',
            'date_created' => Carbon::now(),
            'deleted' => 0
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'admin',
            'date_created' => Carbon::now(),
            'deleted' => 0
        ]);

        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'producer',
            'date_created' => Carbon::now(),
            'deleted' => 0
        ]);
    }
}
