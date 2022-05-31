<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GenresSeeder extends Seeder
{
    //php artisan db:seed --class=GenresSeeder
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            "name" => "Metal",
            "rgb_color" => "rgb(128, 74, 0)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Rock",
            "rgb_color" => "rgb(125, 112, 152)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Hip Hop",
            "rgb_color" => "rgb(250, 193, 0)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Rap",
            "rgb_color" => "rgb(59, 170, 56)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Pop",
            "rgb_color" => "rgb(95,117,142)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Techno",
            "rgb_color" => "rgb(182,221,170)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Urban",
            "rgb_color" => "rgb(181, 104, 12)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Jazz",
            "rgb_color" => "rgb(181, 104, 12)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Classic",
            "rgb_color" => "rgb(208, 173, 96)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Indie",
            "rgb_color" => "rgb(117, 124, 101)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Electronic",
            "rgb_color" => "rgb(140, 178, 213)",
            "date_created" => Carbon::now()
        ]);
    }
}
