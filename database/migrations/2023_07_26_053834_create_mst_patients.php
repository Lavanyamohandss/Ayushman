<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstPatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_code',100);
            $table->string('patient_name',100);
            $table->string('patient_email',200);
            $table->string('patient_mobile',20);
            $table->text('patient_address');
            $table->tinyInteger('patient_gender');
            $table->date('patient_dob');
            $table->bigInteger('patient_blood_group_id');
            $table->string('emergency_contact_person');
            $table->string('emergency_contact');
            $table->integer('maritial_status');
            $table->text('patient_medical_history');
            $table->text('patient_current_medications');
            $table->integer('patient_registration_type');
            $table->integer('is_otp_verified');
            $table->integer('is_approved');
            $table->integer('is_active');
            $table->string('password',200);
            $table->string('whatsapp_number',20);
            $table->string('available_membership',100);
            $table->tinyInteger('is_deleted');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('mst_patients');
    }
}
