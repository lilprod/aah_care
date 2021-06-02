<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_drugs', function (Blueprint $table) {
            $table->id();
            $table->integer('drug_id')->nullable();
            $table->integer('pharmacy_id')->nullable();
            $table->integer('q_stock')->nullable();
            $table->integer('q_minimum')->nullable();
            $table->float('unit_ht')->nullable();
            $table->float('unit_tt')->nullable();
            $table->float('discount')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('pharmacy_drugs');
    }
}
