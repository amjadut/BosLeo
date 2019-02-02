<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')
                            ->references('id')->on('users')
                            ->onDelete('cascade');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')
                            ->references('id')->on('available_roles')
                            ->onDelete('cascade');
            $table->integer('start_year');
            $table->integer('end_year');
            $table->string('organisation_name');
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
        Schema::dropIfExists('doctor_experiences');
    }
}
