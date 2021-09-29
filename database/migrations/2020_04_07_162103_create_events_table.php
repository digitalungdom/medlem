<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug', 15);
            $table->string('name');
            $table->text('description')->nullable();
            $table->dateTime('startTime')->nullable();
            $table->dateTime('stopTime')->nullable();
            $table->boolean('public')->default(false);
            $table->softDeletes();
            $table->integer('maxUsers')->default(-1);
            $table->string('seatmap_original_file')->nullable();
            $table->boolean('mustBeMember')->default(false);
            $table->boolean('canSelectSeat')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
