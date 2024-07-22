<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnMedicinePurchaseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_medicine_purchase_invoices', function (Blueprint $table) {
            $table->bigIncrements('purchase_invoice_id');
            $table->string('purchase_invoice_no', 100);
            $table->bigInteger('supplier_id');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->integer('branch_id');
            $table->integer('financial_year_id');
            $table->string('notes', 500)->nullable();
            $table->string('terms_and_conditions', 500)->nullable();
            $table->decimal('sub_total', 16, 3);
            $table->decimal('item_discount', 14, 3);
            $table->decimal('total_tax', 16, 3);
            $table->decimal('total_amount', 16, 3);
            $table->boolean('has_payment');
            $table->boolean('is_settled');
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->boolean('is_deleted');
            $table->bigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // $table->foreign('supplier_id')->references('supplier_id')->on('mst_suppliers')->onDelete('cascade');
            // $table->foreign('branch_id')->references('branch_id')->on('mst_branches')->onDelete('cascade');
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
        Schema::dropIfExists('trn_medicine_purchase_invoices');
    }
}
