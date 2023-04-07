<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Expenses', function (Blueprint $table) {
            $table->string('id')->unsigned();
            $table->primary('id');
            $table->date('ExpenseDate')->nullbable();
            $table->string('ExpenseFor', 1500)->nullable();
            $table->decimal('Amount', 15, 2)->nullable();
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
        Schema::dropIfExists('Expenses');
    }
}
