<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMstBranches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_branches', function (Blueprint $table) {
            $table->string('branch_code',100);
            $table->string('branch_address',100);
            $table->string('branch_contact_number',100);
            $table->string('branch_email',100);
            $table->string('branch_admin_name',100);
            $table->string('branch_admin_contact_number',100);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('deleted_by');
            
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mst_branches', function (Blueprint $table) {
            //
        });
    }
}
