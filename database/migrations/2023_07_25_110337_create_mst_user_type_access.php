<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstUserTypeAccess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_user_type_access', function (Blueprint $table) {
            $table->id();
            $table->integer('user_type_id');
            $table->integer('module_id');
            $table->integer('page_id');
            $table->integer('is_view');
            $table->integer('is_add');
            $table->integer('is_edit');
            $table->integer('is_delete');
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
        Schema::dropIfExists('mst_user_type_access');
    }
}
