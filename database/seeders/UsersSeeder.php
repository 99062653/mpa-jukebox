<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    //php artisan db:seed --class=UsersSeeder
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'role_id' => 2,
            'username' => 'JukeboxAdmin',
            'password' => '$2y$10$/MZRj.cynzg6EYEQ0xxVm.wF7.3xZnrzNS//.biePC7gXnQzDzueW',
            'date_created' => Carbon::now(),
            'deleted' => 0
        ]);
    }
}
