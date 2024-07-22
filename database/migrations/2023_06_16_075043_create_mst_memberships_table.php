<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_memberships', function (Blueprint $table) {
            $table->id();
            $table->string('membership_name',100);
            $table->integer('validity');
            $table->string('remarks',250);
            $table->boolean('is_active');
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
        Schema::dropIfExists('mst_memberships');
    }
}
