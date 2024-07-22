<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnMedicinePurchaseInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_medicine_purchase_invoice_details', function (Blueprint $table) {
            $table->bigIncrements('purchase_invoice_details_id');
            $table->bigInteger('invoice_id');
            $table->bigInteger('product_id');
            $table->integer('unit_id');
            $table->decimal('quantity', 14, 3);
            $table->decimal('free_quantity', 16, 2);
            $table->integer('free_quantity_unit_id');
            $table->string('batch_no', 100);
            $table->date('mfd');
            $table->date('expd');
            $table->decimal('rate', 16, 3);
            $table->decimal('tax_value', 5, 3);
            $table->decimal('tax_amount', 16, 3);
            $table->decimal('discount', 14, 3);
            $table->decimal('amount', 16, 3);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('invoice_id')->references('purchase_invoice_id')->on('trn_medicine_purchase_invoices')->onDelete('cascade');
            // $table->foreign('created_by')->references('user_id')->on('mst_users')->onDelete('cascade');
            // $table->foreign('updated_by')->references('user_id')->on('mst_users')->onDelete('cascade');
            // $table->foreign('deleted_by')->references('user_id')->on('mst_users')->onDelete('set null');
        });     
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trn_medicine_purchase_invoice_details');
    }
}
