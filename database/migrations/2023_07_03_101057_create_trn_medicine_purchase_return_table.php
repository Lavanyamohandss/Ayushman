<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnMedicinePurchaseReturnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_medicine_purchase_return', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_item_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->string('batch_number',100)->nullable();
            $table->integer('medicine_id')->nullable();
            $table->decimal('unit_price',14,2)->nullable();
            $table->decimal('returned_quantity',14,2)->nullable();
            $table->decimal('total_returned_price',14,2)->nullable();
            $table->integer('purchase_status_id')->nullable();
            $table->date('return_date')->nullable();
            $table->longText('reason')->nullable();
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
        Schema::dropIfExists('trn_medicine_purchase_return');
    }
}
