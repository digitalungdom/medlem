<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostnumber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postnumber', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('postNummer')->unique();
            $table->text('postSted');
            $table->integer('kommuneNummer');
            $table->text('kommuneNavn');
            $table->char('postNummerType');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postnumber');
    }
}
