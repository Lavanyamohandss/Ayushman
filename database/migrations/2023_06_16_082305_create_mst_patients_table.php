<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstPatientsTable extends Migration
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
            $table->string('patient_code',50);
            $table->string('patient_name',100);
            $table->string('patient_email',200);
            $table->string('patient_mobile',20);
            $table->string('patient_address',200);
            $table->tinyInteger('patient_gender');
            $table->date('patient_dob');
            $table->boolean('is_active');
            $table->string('username',100);
            $table->string('password',200);
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
        Schema::dropIfExists('mst_patients');
    }
}
