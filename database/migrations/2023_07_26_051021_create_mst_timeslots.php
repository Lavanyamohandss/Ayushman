<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstTimeslots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_timeslots', function (Blueprint $table) {
            $table->id();
            $table->integer('staff_id');
            $table->integer('week_day');
            $table->time('time_from');
            $table->time('time_to');
            $table->string('avg_time_patient');
            $table->integer('no_tokens');
            $table->integer('is_available');
            $table->integer('is_active');
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
        Schema::dropIfExists('mst_timeslots');
    }
}
