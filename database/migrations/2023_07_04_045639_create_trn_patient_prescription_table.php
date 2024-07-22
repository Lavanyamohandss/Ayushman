<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnPatientPrescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_patient_prescription', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->string('prescription_code',100)->nullable();
            $table->integer('doctor_id')->nullable();
            $table->integer('medicine_id')->nullable();
            $table->integer('check_morning')->nullable();
            $table->integer('check_noon')->nullable();
            $table->integer('check_night')->nullable();
            $table->integer('is_before_food')->nullable();
            $table->text('instruction')->nullable();
            $table->date('prescription_date')->nullable();
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
        Schema::dropIfExists('trn_patient_prescription');
    }
}
