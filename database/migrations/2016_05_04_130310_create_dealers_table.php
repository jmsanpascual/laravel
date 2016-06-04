<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->integer('region_id')->unsigned()->index();
            $table->foreign('region_id')->references('id')->on('regions')
                ->onDelete('cascade');
            $table->integer('courier_id')->unsigned()->nullable();
            $table->foreign('courier_id')->references('id')->on('couriers');
            $table->string('city', 50);
            $table->string('province', 50);
            $table->string('contact_person', 50);
            $table->string('contact_number', 50);
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
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
        Schema::drop('dealers');
    }
}
