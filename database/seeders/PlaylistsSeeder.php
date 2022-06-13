<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PlaylistsSeeder extends Seeder
{
    //php artisan db:seed --class=PlaylistsSeeder
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('playlists')->insert([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Heetste Tracks',
            'rgb_color' => 'rgb(59, 170, 56)',
            'date_created' => Carbon::now(),
            'deleted' => 0
        ]);
    }
}
