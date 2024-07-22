<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnMedicinePurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_medicine_purchase_order', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_order_number',100)->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('medicine_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('purchase_status_id')->nullable();
            $table->date('purchase_date')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('trn_medicine_purchase_order');
    }
}
