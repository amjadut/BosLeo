<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicTimingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_timings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clinic_id')->unsigned();
            $table->foreign('clinic_id')
                            ->references('id')->on('clinics')
                            ->onDelete('cascade');
            $table->integer('day_id')->unsigned();
            $table->foreign('day_id')
                            ->references('id')->on('available_days')
                            ->onDelete('cascade');
            $table->time('from_time');
            $table->time('to_time');
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
        Schema::dropIfExists('clinic_timings');
    }
}
