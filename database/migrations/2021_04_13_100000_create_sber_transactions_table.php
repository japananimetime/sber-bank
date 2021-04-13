<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSberTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sber_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('sber_id');
            $table->string('orderNumber');
            $table->integer('amount')->unsigned();
            $table->bigInteger('user_id');
            $table->text('jsonParams');
            $table->integer('status')->unsigned();
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
        Schema::dropIfExists('sber_transactions');
    }
}
