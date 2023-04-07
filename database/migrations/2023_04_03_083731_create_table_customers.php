<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Customers', function (Blueprint $table) {
            $table->string('id')->unsigned();
            $table->primary('id');
            $table->string('FullName', 500)->nullable();
            $table->string('Town')->nullable();
            $table->string('Barangay')->nullable();
            $table->string('Purok', 500)->nullable();
            $table->string('ContactNumber')->nullable();
            $table->string('Email')->nullable();
            $table->string('CustomerTechnicalId')->nullable();
            $table->date('DateConnected')->nullable();
            $table->string('UserId')->nullable();
            $table->string('Trash')->nullable();
            $table->string('Status')->nullable();
            $table->string('Latitude')->nullable();
            $table->string('Longitude')->nullable();
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
        Schema::dropIfExists('Customers');
    }
}
