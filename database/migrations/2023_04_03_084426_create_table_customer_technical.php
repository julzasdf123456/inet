<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCustomerTechnical extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CustomerTechnical', function (Blueprint $table) {
            $table->string('id')->unsigned();
            $table->primary('id');
            $table->string('CustomerId')->nullable();
            $table->string('SpeedSubscribed')->nullable();
            $table->decimal('MonthlyPayment', 15, 2)->nullable();
            $table->string('MacAddress')->nullable();
            $table->string('ModemId')->nullable();
            $table->string('ModemBrand')->nullable();
            $table->string('ModemNumber')->nullable();
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
        Schema::dropIfExists('CustomerTechnical');
    }
}
