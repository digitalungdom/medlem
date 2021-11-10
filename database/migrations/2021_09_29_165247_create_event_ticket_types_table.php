<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTicketTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_ticket_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('event_id')->constrained();
            $table->string('name',75);
            $table->integer('price')->nullable()->default(0);
            $table->integer('maxPerUser')->default(1);
            $table->text('description')->nullable();
            $table->boolean('enabled')->nullable()->default(false);
            $table->boolean('seatable')->nullable()->default(true);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_ticket_types');
    }
}
