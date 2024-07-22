<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_users', function (Blueprint $table) {
            $table->id();
            $table->string('username',100);
            $table->string('password',200);
            $table->tinyInteger('user_type_id');
            $table->integer('staff_id');
            $table->string('user_email',200);
            $table->boolean('is_active');
            $table->integer('branch_id');
            $table->dateTime('last_login_time');
            $table->integer('created_by');
            $table->integer('last_updated_by');
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
        Schema::dropIfExists('mst_users');
    }
}
