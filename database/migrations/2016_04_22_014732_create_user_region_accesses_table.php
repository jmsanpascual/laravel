<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRegionAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_region_accesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('region_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->integer('permission')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_region_accesses');
    }
}
