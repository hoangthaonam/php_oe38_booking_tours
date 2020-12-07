<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('tour_id');
            $table->string('name');
            $table->string('image');
            $table->string('slug');
            $table->string('place_from');
            $table->string('place_to');
            $table->string('place_tobe');
            $table->integer('duration');
            $table->decimal('price', 15, 2);
            $table->integer('hotel_star');
            $table->longText('des');
            $table->integer('quantity_people');
            $table->integer('booking_number');
            $table->integer('category_id')->unsigned();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tours');
        Schema::enableForeignKeyConstraints();
    }
}
