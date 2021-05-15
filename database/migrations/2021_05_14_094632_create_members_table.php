<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('no', 10);
            $table->string('title', 30);
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('house_no', 50)->nullable();
            $table->string('moo', 50)->nullable();
            $table->string('street', 255)->nullable();
            $table->string('sub_district', 255);
            $table->string('district', 255);
            $table->string('province', 255);
            $table->string('post_code', 10);
            $table->string('id_card_no', 30);
            $table->string('mobile', 50);
            $table->string('career', 50);
            $table->double('debt_in_credit_bureau', 11,2)->default(0);
            $table->double('debt_out_credit_bureau', 11,2)->default(0);
            $table->double('informal_debt', 11,2)->default(0);
            $table->double('total', 11,2)->default(0);
            $table->string('saving_per_month', 50);
            $table->string('remarks', 255)->nullable();
            $table->timestamps();
            $table->index(['id_card_no'], 'members_idx1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
