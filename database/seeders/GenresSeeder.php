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

        DB::table('genres')->insert([
            "name" => "Experimental",
            "rgb_color" => "rgb(105, 12, 117)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Funk",
            "rgb_color" => "rgb(40, 139, 37)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Disco",
            "rgb_color" => "rgb(180, 28, 28)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Christian",
            "rgb_color" => "rgb(8, 199, 167)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Ska",
            "rgb_color" => "rgb(194, 191, 33)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Rave",
            "rgb_color" => "rgb(196, 93, 173)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Soul Flow",
            "rgb_color" => "rgb(178, 132, 71)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Boom Bap",
            "rgb_color" => "rgb(79, 133, 89)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Dutch House",
            "rgb_color" => "rgb(42, 171, 152)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Futurepop",
            "rgb_color" => "rgb(149, 177, 80)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "EDM",
            "rgb_color" => "rgb(67, 232, 218)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "G-House",
            "rgb_color" => "rgb(127, 119, 82)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Drift Phonk",
            "rgb_color" => "rgb(127, 37, 183)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Tallava",
            "rgb_color" => "rgb(127, 137, 28)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Discofox",
            "rgb_color" => "rgb(119, 53, 67)",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Lilith",
            "rgb_color" => "rgb(19, 232, 16)",
            "date_created" => Carbon::now()
        ]);
    }
}
