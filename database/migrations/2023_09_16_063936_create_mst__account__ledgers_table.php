<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstAccountLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst__account__ledgers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_sub_group_id');
            $table->integer('ledger_code');
            $table->string('ledger_name',100);
            $table->string('notes',100);
            $table->tinyInteger('is_active')->default(1)->comment('0: not active, 1: active');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('account_sub_group_id')->references('id')->on('sys__account__groups')->onDelete('cascade');
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
        Schema::dropIfExists('mst__account__ledgers');
    }
}
