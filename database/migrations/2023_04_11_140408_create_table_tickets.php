<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tickets', function (Blueprint $table) {
            $table->string('id')->unsigned();
            $table->primary('id');
            $table->string('CustomerId')->nullable();
            $table->string('CustomerName', 600)->nullable();
            $table->string('Town')->nullable();
            $table->string('Barangay')->nullable();
            $table->string('Ticket')->nullable();
            $table->string('Details', 600)->nullable();
            $table->string('Notes', 1000)->nullable();
            $table->string('Status')->nullable();
            $table->string('Latitude')->nullable();
            $table->string('Longitude')->nullable();
            $table->string('ExecutedBy')->nullable();
            $table->string('UserId')->nullable();
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
        Schema::dropIfExists('Tickets');
    }
}
