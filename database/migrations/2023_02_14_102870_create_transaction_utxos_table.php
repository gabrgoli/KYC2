<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionUtxosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_utxos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wallet_transaction_id');
            $table->foreign('wallet_transaction_id')->references('id')->on('wallet_transactions');
            $table->string('input_output');
            $table->string('payment_address');
            $table->string('stake_address')->nullable();
            $table->bigInteger('value');
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
        Schema::dropIfExists('transaction_inputs');
    }
}
