<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstManufacturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst__manufacturers', function (Blueprint $table) {
            $table->bigIncrements('manufacturer_id')->unsigned();
            $table->string('name');
            $table->tinyInteger('is_active')->default(0)->comment('0: not active, 1: active');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('created_by')->references('user_id')->on('mst_users')->onDelete('cascade');
            $table->foreign('updated_by')->references('user_id')->on('mst_users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('user_id')->on('mst_users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst__manufacturers');
    }
}
