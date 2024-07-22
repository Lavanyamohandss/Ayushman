<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstStaffs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_staffs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_type');
            $table->bigInteger('employment_type');
            $table->string('staff_code',50);
            $table->string('staff_username',100);
            $table->string('password',100);
            $table->string('staff_name',100);
            $table->bigInteger('gender');
            $table->boolean('is_active');
            $table->integer('branch_id');
            $table->date('date_of_birth');
            $table->string('staff_email',100);
            $table->string('staff_contact_number',100);
            $table->text('staff_address');
            $table->bigInteger('staff_qualification');
            $table->string('staff_work_experience',200);
            $table->bigInteger('staff_logon_type');
            $table->integer('staff_commission_type');
            $table->decimal('staff_commission');
            $table->decimal('staff_booking_fee');
            $table->dateTime('last_login_time');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('mst_staffs');
    }
}
