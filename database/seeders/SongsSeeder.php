<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SongsSeeder extends Seeder
{
    //php artisan db:seed --class=SongsSeeder
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('songs')->insert([
            "name" => "Paranoid",
            "length" => 2.47,
            "artist" => "Black Sabbath",
            "cover_art" => "https://upload.wikimedia.org/wikipedia/en/thumb/c/c9/Paranoid.jpg/220px-Paranoid.jpg",
            "date_created" => Carbon::createFromDate(1970, 9, 18),
            "date_added" => Carbon::now()
        ]);

        DB::table('songs')->insert([
            "name" => "i",
            "length" => 3.51,
            "artist" => "Kendrick Lamar",
            "cover_art" => "",
            "date_created" => Carbon::createFromDate(2015, 9, 23),
            "date_added" => Carbon::now()
        ]);
    }
}
