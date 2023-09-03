<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSmsNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SMSNotifications', function (Blueprint $table) {
            $table->string('id')->unsigned();
            $table->primary('id');
            $table->string('ContactNumber');
            $table->string('Message', 500)->nullable();
            $table->string('CustomerId')->nullable();
            $table->date('BillingMonth')->nullable();
            $table->string('Type')->nullable();
            $table->string('Status')->nullable();
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
        Schema::dropIfExists('SMSNotifications');
    }
}
