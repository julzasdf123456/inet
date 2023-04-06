<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePaymentTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PaymentTransactions', function (Blueprint $table) {
            $table->string('id')->unsigned();
            $table->primary('id');
            $table->string('CustomerId')->nullable();
            $table->string('CustomerName', 500)->nullable();
            $table->string('PaymentFor', 1500)->nullable();
            $table->date('BillingMonth')->nullable();
            $table->string('ORNumber')->nullable();
            $table->datetime('PaymentDate')->nullable();
            $table->decimal('AmountPaid', 15, 2)->nullable();
            $table->string('PaymentType')->nullable(); // BILL, OTHERS
            $table->string('Trash')->nullable();
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
        Schema::dropIfExists('PaymentTransactions');
    }
}
