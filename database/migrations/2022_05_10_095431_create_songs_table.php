<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->text("name");
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            $table->float("length");
            $table->text("artist");
            $table->text("cover_art");
            $table->date("date_created");
            $table->date("date_added");
            $table->boolean("deleted")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
};
