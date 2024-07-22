<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_availabilities', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->integer('booking_type_id')->nullable();
            $table->integer('doctor_id')->nullable();
            $table->date('availability_date')->nullable();
            $table->integer('time_slot_id')->nullable();
            $table->integer('maxing_bookings')->nullable();
            $table->integer('availability_status')->nullable();
            $table->integer('therapy_id')->nullable();
            $table->integer('wellness_id')->nullable();
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
        Schema::dropIfExists('booking_availabilities');
    }
}
