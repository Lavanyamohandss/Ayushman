<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_user_profile', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('blood_group_id')->nullable();
            $table->integer('gender_id')->nullable();
            $table->longText('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('profile_image',100)->nullable();
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
        Schema::dropIfExists('trn_user_profile');
    }
}
