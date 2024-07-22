<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstLedgerTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_ledger_types', function (Blueprint $table) {
            $table->id();
            $table->integer('account_type_id')->nullable();
            $table->string('ledger_name',100)->nullable();
            $table->text('ledger_description')->nullable();
            $table->integer('account_id')->nullable();
            $table->integer('account_sub_head_id')->nullable();
            $table->integer('ledger_status')->nullable();
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
        Schema::dropIfExists('mst_ledger_types');
    }
}
