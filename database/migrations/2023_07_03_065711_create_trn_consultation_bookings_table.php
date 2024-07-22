<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnConsultationBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_consultation_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_reference_number',100)->nullable();
            $table->integer('booking_type_id')->nullable();
            $table->integer('patient_id')->nullable();
            $table->integer('is_membership_available')->nullable();
            $table->integer('doctor_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->date('booking_date')->nullable();
            $table->integer('time_slot_id')->nullable();
            $table->integer('booking_status_id')->nullable();
            $table->integer('availability_id')->nullable();
            $table->integer('therapy_id')->nullable();
            $table->integer('wellness_id')->nullable();
            $table->integer('is_paid')->nullable();
            $table->integer('is_otp_verified')->nullable();
            $table->string('verification_otp',100)->nullable();
            $table->integer('external_doctor_id')->nullable();
            $table->decimal('booking_fee',14,2)->nullable();
            $table->decimal('discount',14,2)->nullable();
            $table->integer('is_for_family_member')->nullable();
            $table->integer('family_member_id')->nullable();
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
        Schema::dropIfExists('trn_consultation_bookings');
    }
}
