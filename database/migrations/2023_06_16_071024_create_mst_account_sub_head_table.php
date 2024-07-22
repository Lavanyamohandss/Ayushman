<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstAccountSubHeadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_account_sub_head', function (Blueprint $table) {
            $table->id();
            $table->integer('master_value_id');
            $table->string('account_sub_group_name',100);
            $table->boolean('is_active');
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
        Schema::dropIfExists('mst_account_sub_head');
    }
}
