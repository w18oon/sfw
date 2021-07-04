<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postcodes', function (Blueprint $table) {
            $table->id();
            $table->string('province');
            $table->string('district');
            $table->string('sub_district');
            $table->string('postcode');
            $table->index('province', 'postcodes_idx1');
            $table->index(['province', 'district'], 'postcodes_idx2');
            $table->index(['province', 'district', 'sub_district'], 'postcodes_idx3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postcodes');
    }
}
