<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegionColumnProvincesTable extends Migration
{
    public function up()
    {
        Schema::table('provinces', function (Blueprint $table) {
            $table->string('region_name_th', 30);
        });
    }

    public function down()
    {
        Schema::table('provinces', function (Blueprint $table) {
            $table->dropColumn('region_name_th');
        });
    }
}
