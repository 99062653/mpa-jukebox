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
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Rock",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Hip Hop",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Rap",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Pop",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Techno",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Urban",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Jazz",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Classic",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Indie",
            "date_created" => Carbon::now()
        ]);

        DB::table('genres')->insert([
            "name" => "Electronic",
            "date_created" => Carbon::now()
        ]);
    }
}
