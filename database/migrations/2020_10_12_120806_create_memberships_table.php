<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->datetime('startTime');
            $table->datetime('stopTime');
            $table->foreignId('user_id');
            $table->foreignId('membership_type_id');


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('membership_type_id')->references('id')->on('membership_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memberships');
    }
}

