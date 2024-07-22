<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_taxes', function (Blueprint $table) {
            $table->id('tax_id');
            $table->string('tax_name',50)->nullable();
            $table->decimal('tax_value',11,2)->nullable();
            $table->tinyInteger('is_removed')->nullable();
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
        Schema::dropIfExists('mst_taxes');
    }
}
