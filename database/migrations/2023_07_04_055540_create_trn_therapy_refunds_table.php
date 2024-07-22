<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnTherapyRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_therapy_refunds', function (Blueprint $table) {
            $table->id();
            $table->integer('therapy_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('patient_id')->nullable();
            $table->integer('refund_status')->nullable();
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
        Schema::dropIfExists('trn_therapy_refunds');
    }
}
