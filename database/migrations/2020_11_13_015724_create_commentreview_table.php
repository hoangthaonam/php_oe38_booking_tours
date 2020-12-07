<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentreviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('commentreviews', function (Blueprint $table) {
            $table->increments('cmr_id');
            $table->integer('user_id')->unsigned();
            $table->integer('tour_id')->unsigned();
            $table->longText('content');
            $table->integer('type');
            $table->integer('parent_id')->unsigned()->nullable();
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
        Schema::dropIfExists('commentreviews');
        Schema::enableForeignKeyConstraints();
    }
}
