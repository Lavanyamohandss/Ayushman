<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_suppliers', function (Blueprint $table) {
            $table->id('supplier_id');
            $table->tinyInteger('supplier_type_id');
            $table->string('supplier_code',100);
            $table->string('supplier_name',200);
            $table->string('supplier_address',255);
            $table->string('supplier_city',50);
            $table->string('state',50);
            $table->string('country',100);
            $table->string('pincode',20);
            $table->string('business_name',200);
            $table->string('phone_1',20);
            $table->string('phone_2',20);
            $table->string('email',200);
            $table->string('website',100);
            $table->string('GSTNO',20);
            $table->tinyInteger('gst_treatrment');
            $table->integer('credit_period');
            $table->decimal('credit_limit',12,2);
            $table->decimal('opening_balance',15,2);
            $table->tinyInteger('opening_balance_type');
            $table->boolean('is_active');
            $table->integer('account_ledger_id');
            $table->string('terms_and_conditions',300);
            $table->date('opening_balance_date');
            $table->boolean('is_deleted')->nullable();
            $table->dateTime('deleted_on')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('mst_suppliers');
    }
}
