<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysMasterValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_master_values', function (Blueprint $table) {
            $table->id();
            $table->integer('master_id');
            $table->string('master_value',200);
            $table->string('master_value_code',50);
            $table->string('description',250);
            $table->boolean('is_active');
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
        Schema::dropIfExists('sys_master_values');
    }
}
