<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnLedgerPostingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_ledger_postings', function (Blueprint $table) {
            $table->bigIncrements('ledger_posting_id');
            $table->date('posting_date');
            $table->tinyInteger('voucher_type_id');
            $table->bigInteger('master_id');
            $table->bigInteger('account_ledger_id');
            $table->decimal('debit', 16, 3);
            $table->decimal('credit', 16, 3);
            $table->integer('branch_id');
            $table->decimal('transaction_amount', 16, 3);
            $table->string('narration', 250)->nullable();
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
        Schema::dropIfExists('trn_ledger_postings');
    }
}
