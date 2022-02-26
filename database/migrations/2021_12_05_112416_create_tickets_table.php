<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('ticketType')->references('id')->on('event_ticket_types');
            $table->string('payment_id')->nullable();
            $table->string('payment_price')->nullable();
            $table->datetime('payment_date')->nullable();
            $table->foreignId('owner')->references('id')->on('users');
            $table->foreignId('paid_by')->nullable()->references('id')->on('users')->constrained();
            $table->foreignId('seater')->nullable()->references('id')->on('users')->constrained();
            $table->foreignId('user')->nullable()->references('id')->on('users')->constrained();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
