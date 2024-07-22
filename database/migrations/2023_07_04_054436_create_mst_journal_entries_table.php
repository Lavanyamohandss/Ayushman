<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstJournalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_journal_entries', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->nullable();
            $table->integer('account_sub_head_id')->nullable();
            $table->date('entry_date')->nullable();
            $table->text('entry_description')->nullable();
            $table->integer('from_account')->nullable();
            $table->integer('to_account')->nullable();
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
        Schema::dropIfExists('mst_journal_entries');
    }
}
