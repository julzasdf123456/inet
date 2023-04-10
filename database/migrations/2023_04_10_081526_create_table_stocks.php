<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Stocks', function (Blueprint $table) {
            $table->string('id')->unsigned();
            $table->primary('id');
            $table->string('StockName')->nullable();
            $table->string('Description', 600)->nullable();
            $table->string('Type')->nullable();
            $table->string('CanBeChargedToCustomer')->nullable();
            $table->decimal('RetailPrice', 15, 2)->nullable();
            $table->string('Unit')->nullable();
            $table->string('StockQuantity')->nullable();
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
        Schema::dropIfExists('Stocks');
    }
}
