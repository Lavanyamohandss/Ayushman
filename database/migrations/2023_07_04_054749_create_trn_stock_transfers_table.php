<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnStockTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_stock_transfers', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->integer('transfer_type')->nullable();
            $table->integer('medicine_id')->nullable();
            $table->decimal('transfered_stock',14,2)->nullable();
            $table->integer('to_branch_id')->nullable();
            $table->integer('stock_status')->nullable();
            $table->integer('therapy_id')->nullable();
            $table->integer('transfered_by')->nullable();
            $table->integer('requested_by')->nullable();
            $table->date('initiated_date')->nullable();
            $table->date('completion_date')->nullable();
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
        Schema::dropIfExists('trn_stock_transfers');
    }
}
