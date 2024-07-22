<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnLedgerEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_ledger_entries', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->integer('ledger_id')->nullable();
            $table->integer('account_id')->nullable();
            $table->integer('account_sub_head_id')->nullable();
            $table->date('entry_date')->nullable();
            $table->text('entry_description')->nullable();
            $table->decimal('credit_amount',14,2)->nullable();
            $table->decimal('debit_amount',14,2)->nullable();
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
        Schema::dropIfExists('trn_ledger_entries');
    }
}
