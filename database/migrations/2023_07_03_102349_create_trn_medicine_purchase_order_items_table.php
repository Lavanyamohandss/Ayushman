<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnMedicinePurchaseOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_medicine_purchase_order_items', function (Blueprint $table) {
            $table->id('purchase_item_id');
            $table->integer('purchase_order_id');
            $table->string('batch_number',100);
            $table->integer('medicine_id');
            $table->integer('unit_id');
            $table->decimal('unit_price',14,2);
            $table->decimal('total_quantity',14,2);
            $table->decimal('total_price',14,2);
            $table->decimal('total_paid',14,2);
            $table->decimal('discount',14,2);
            $table->integer('created_by');
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
        Schema::dropIfExists('trn_medicine_purchase_order_items');
    }
}
