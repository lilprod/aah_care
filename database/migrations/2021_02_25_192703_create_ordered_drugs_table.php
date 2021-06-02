<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderedDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_drugs', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->integer('drug_id')->nullable();
            $table->date('expire_at')->nullable();
            $table->integer('pharmacy_id')->nullable();
            $table->string('supplier_id')->nullable();
            $table->integer('qte_stock')->nullable();
            $table->float('ht')->nullable();
            $table->float('tt')->nullable();
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
        Schema::dropIfExists('ordered_drugs');
    }
}
