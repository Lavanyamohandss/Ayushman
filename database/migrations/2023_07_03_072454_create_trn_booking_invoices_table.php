<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnBookingInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_booking_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id')->nullable();
            $table->string('booking_invoice_number',100)->nullable();
            $table->date('invoice_date')->nullable();
            $table->decimal('paid_amount',14,2)->nullable();
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
        Schema::dropIfExists('trn_booking_invoices');
    }
}
