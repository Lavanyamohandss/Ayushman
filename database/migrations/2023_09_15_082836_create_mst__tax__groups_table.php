<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstTaxGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst__tax__groups', function (Blueprint $table) {
            $table->id();
            $table->string('tax_group_name',100);
            $table->integer('included_tax');
            $table->tinyInteger('is_active')->default(1)->comment('0: not active, 1: active');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('mst__tax__groups');
    }
}
