<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatmapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seatmaps', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('event')->references('id')->on('events');
        });

        Schema::create('seatmap_seat', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('seatmap')->references('id')->on('seatmap')->onDelete('cascade');
            $table->string('svgid');
            $table->string('svgtype')->nullable();
            $table->string('name')->nullable();
            $table->boolean('isOpen')->default(false);
            $table->boolean('isSeat')->default(false);
            $table->text('svgclass')->nullable();
            $table->bigInteger('user')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->integer('svgX1')->nullable();
            $table->integer('svgY1')->nullable();
            $table->integer('svgX2')->nullable();
            $table->integer('svgY2')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->text('text')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seatmaps');
        Schema::dropIfExists('seatmap_seat');
    }
}
