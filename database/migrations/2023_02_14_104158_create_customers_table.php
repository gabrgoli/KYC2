<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('UUID');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('price_in_ada')->default(0);
            $table->integer('dust')->default(0);
            $table->unsignedBigInteger('in_wallet_transaction_id')->nullable();
            $table->foreign('in_wallet_transaction_id')->references('id')->on('wallet_transactions');
            $table->unsignedBigInteger('out_wallet_transaction_id')->nullable();
            $table->foreign('out_wallet_transaction_id')->references('id')->on('wallet_transactions');
            $table->text('token_data')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
