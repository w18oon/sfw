<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->softDeletes();
            $table->double('debt_type_2', 9, 2)->comment('หนี้สินนอกระบบแบบถูกกฏหมาย');
            $table->double('debt_type_3', 9, 2)->comment('หนี้สินนอกระบบแบบผิดกฏหมาย');
            $table->double('debt_type_4', 9, 2)->comment('หนี้สินแบบสหกรณ์');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('debt_type_2');
            $table->dropColumn('debt_type_3');
            $table->dropColumn('debt_type_4');
        });
    }
}
