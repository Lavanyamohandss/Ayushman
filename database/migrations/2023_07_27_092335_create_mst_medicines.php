<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstMedicines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_medicines', function (Blueprint $table) {
            $table->id();
            $table->string('medicine_name',100);
            $table->string('generic_name',100);
            $table->integer('item_type');
            $table->integer('medicine_type');
            $table->string('Hsn_code',100);
            $table->integer('tax_id');
            $table->integer('dosage_from');
            $table->integer('manufacturer');
            $table->decimal('unit_price',14,2);
            $table->text('description');
            $table->integer('is_active');
            $table->decimal('reorder_limit',14,2);
            $table->integer('branch_id');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('deleted_by');
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
        Schema::dropIfExists('mst_medicines');
    }
}
