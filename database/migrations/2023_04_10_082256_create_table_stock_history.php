<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStockHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StockHistory', function (Blueprint $table) {
            $table->string('id')->unsigned();
            $table->primary('id');
            $table->string('StockId');
            $table->decimal('Quantity', 15, 2)->nullable();
            $table->string('UserId')->nullable();
            $table->date('DateStocked')->nullable();
            $table->string('Notes', 500)->nullable();
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
        Schema::dropIfExists('StockHistory');
    }
}
