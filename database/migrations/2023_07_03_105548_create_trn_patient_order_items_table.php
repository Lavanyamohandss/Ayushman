<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnPatientOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_patient_order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_order_id')->nullable();
            $table->integer('medicine_id')->nullable();
            $table->decimal('unit_price',14,2)->nullable();
            $table->decimal('quantity',14,2)->nullable();
            $table->decimal('total_price',14,2)->nullable();
            $table->decimal('discount',14,2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trn_patient_order_items');
    }
}
