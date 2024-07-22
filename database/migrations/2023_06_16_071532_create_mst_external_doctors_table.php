<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstExternalDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_external_doctors', function (Blueprint $table) {
            $table->id();
            $table->string('doctor_name',100);
            $table->string('contact_no',20);
            $table->string('contact_email',50);
            $table->string('address',200);
            $table->boolean('is_deleted');
            $table->integer('deleted_by');
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_external_doctors');
    }
}
