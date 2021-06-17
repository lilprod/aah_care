<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_classes', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id')->nullable();
            $table->integer('doctor_user_id')->nullable();
            $table->string('country')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('region')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('city')->nullable();
            $table->integer('views_count')->unsigned()->default(0);
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
        Schema::dropIfExists('doctor_classes');
    }
}
