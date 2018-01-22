<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pictures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pictures');

        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->binary('image');
            $table->integer('add_id')->unsigned()->index();

            $table->foreign('add_id')
                  ->references('id')
                  ->on('adverts')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pictures');
    }

}
