<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnPatientOrderItemReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_patient_order_item_returns', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_order_item_id');
            $table->integer('patient_id');
            $table->integer('medicine_id');
            $table->decimal('unit_price',14,2)->nullable();
            $table->decimal('quantity',14,2)->nullable();
            $table->decimal('total_price',14,2)->nullable();
            $table->decimal('discount',14,2)->nullable();
            $table->date('return_date')->nullable();
            $table->longText('return_reason')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('trn_patient_order_item_returns');
    }
}
