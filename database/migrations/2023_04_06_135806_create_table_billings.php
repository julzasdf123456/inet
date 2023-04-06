<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBillings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Billings', function (Blueprint $table) {
            $table->string('id')->unsigned();
            $table->primary('id');
            $table->string('BillNumber')->nullable();
            $table->string('CustomerId')->nullable();
            $table->date('BillingMonth')->nullable();
            $table->date('BillingDate')->nullable();
            $table->date('DueDate')->nullable();
            $table->decimal('BillAmountDue', 15, 2)->nullable();
            $table->decimal('AdditionalPayments', 15, 2)->nullable();
            $table->decimal('Deductions', 15, 2)->nullable();
            $table->decimal('TotalAmountDue', 15, 2)->nullable();
            $table->decimal('PaidAmount', 15, 2)->nullable();
            $table->decimal('Balance', 15, 2)->nullable();
            $table->string('Notes', 1500)->nullable();
            $table->string('SMSSent')->nullable();
            $table->string('EmailSent')->nullable();
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
        Schema::dropIfExists('Billings');
    }
}
