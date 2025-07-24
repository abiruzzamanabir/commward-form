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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->double('amount')->nullable()->default(null);
            $table->text('address')->nullable()->default(null);
            $table->string('status')->nullable()->default(null);
            $table->string('transaction_id')->nullable()->default(null);
            $table->string('currency')->nullable()->default(null);
            $table->string('card_issuer')->nullable()->default(null);
            $table->string('bank_tran_id')->nullable()->default(null);
            $table->string('tran_date')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
