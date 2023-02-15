<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_utxo_id');
            $table->foreign('transaction_utxo_id')->references('id')->on('transaction_utxos');
            $table->string('policy_id');
            $table->string('asset_name');
            $table->bigInteger('quantity');
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
        Schema::dropIfExists('transaction_assets');
    }
}
