<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstMasterValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()                                                                                                                                                                
    {
        Schema::create('mst_master_values', function (Blueprint $table) {
            $table->id();
            $table->integer('master_id');
            $table->integer('group_id');
            $table->string('master_value',200);
            $table->boolean('is_active');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('mst_master_values');
    }
}
