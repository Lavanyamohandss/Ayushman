<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnPatientOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_patient_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->string('order_number',100)->nullable();
            $table->integer('patient_id')->nullable();
            $table->integer('order_status_id')->nullable();
            $table->date('order_date')->nullable();
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
        Schema::dropIfExists('trn_patient_orders');
    }
}
