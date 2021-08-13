<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDebtsTable extends Migration
{
    public function up()
    {
        Schema::table('debts', function (Blueprint $table) {
            $table->string('desc', 100)->change();
            $table->renameColumn('desc', 'bank_name');
            $table->string('bank_branch', 100)->nullable();
            $table->string('contact', 10);
            $table->string('contract_no', 30)->nullable();
            $table->string('contract_date', 10)->nullable();
            $table->string('status', 50);
            $table->string('other_status', 100)->nullable();
            $table->string('date_1', 10)->nullable()->comment('วันที่ถูกฟ้องต่อศาล');;
            $table->string('date_2', 10)->nullable()->comment('วันที่ถูกบังคับคดี');;
            $table->string('interest', 10)->nullable();
        });
    }

    public function down()
    {
        Schema::table('debts', function (Blueprint $table) {
            $table->string('bank_name', 255)->change();
            $table->renameColumn('bank_name', 'desc');
            $table->dropColumn('bank_branch');
            $table->dropColumn('contact');
            $table->dropColumn('contract_no');
            $table->dropColumn('contract_date');
            $table->dropColumn('status');
            $table->dropColumn('other_status');
            $table->dropColumn('date_1');
            $table->dropColumn('date_2');
            $table->dropColumn('interest');
        });
    }
}
