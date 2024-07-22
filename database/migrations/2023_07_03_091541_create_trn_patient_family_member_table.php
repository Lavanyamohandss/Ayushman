<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnPatientFamilyMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_patient_family_member', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id')->nullable();
            $table->string('family_member_name',100)->nullable();
            $table->integer('gender_id')->nullable();
            $table->integer('blood_group_id')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('is_active')->nullable();
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
        Schema::dropIfExists('trn_patient_family_member');
    }
}
