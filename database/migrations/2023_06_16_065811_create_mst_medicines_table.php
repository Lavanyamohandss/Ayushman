<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_medicines', function (Blueprint $table) {
            $table->id();
            $table->string('medicine_code',50);
            $table->string('medicine_name',200);
            $table->string('generic_name',200);
            $table->integer('medicine_category_id');
            $table->integer('unit_id');
            $table->boolean('has_batch');
            $table->decimal('sale_rate',14,2);
            $table->integer('tax_id');
            $table->decimal('reorder_level',14,2);
            $table->boolean('allow_batch');
            $table->string('remarks',250);
            $table->boolean('is_active');
            $table->boolean('is_deleted');
            $table->integer('deleted_by');
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
        Schema::dropIfExists('mst_medicines');
    }
}
