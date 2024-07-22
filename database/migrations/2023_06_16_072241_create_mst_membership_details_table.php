<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstMembershipDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_membership_details', function (Blueprint $table) {
            $table->id();
            $table->integer('membership_id');
            $table->tinyInteger('inclusion_type_id');
            $table->integer('therapy_id');
            $table->integer('wellness_id');
            $table->tinyInteger('count');
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
        Schema::dropIfExists('mst_membership_details');
    }
}
