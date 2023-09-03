<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTicketLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TicketLogs', function (Blueprint $table) {
            $table->string('id')->unsigned();
            $table->primary('id');
            $table->string('TicketId')->nullable();
            $table->string('UserId')->nullable();
            $table->string('LogDetails', 1000)->nullable();
            $table->string('Notes', 1000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TicketLogs');
    }
}
