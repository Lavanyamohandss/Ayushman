<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnWellnessBookingInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_wellness_booking_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id');
            $table->integer('wellness_id');
            $table->string('booking_invoice_number',100);
            $table->date('invoice_date');
            $table->decimal('paid_amount',14,2);
            $table->integer('payment_type');
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
        Schema::dropIfExists('trn_wellness_booking_invoices');
    }
}
