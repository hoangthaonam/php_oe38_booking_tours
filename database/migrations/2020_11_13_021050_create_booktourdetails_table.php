<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooktourdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('booktourdetails', function (Blueprint $table) {
            $table->increments('booktourdetails_id');
            $table->integer('tour_id')->unsigned();
            $table->integer('booktour_id')->unsigned();
            $table->string('tour_name');
            $table->integer('quantity_people');
            $table->decimal('price', 15, 2);
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
        Schema::dropIfExists('booktourdetails');
        Schema::enableForeignKeyConstraints();
    }
}
