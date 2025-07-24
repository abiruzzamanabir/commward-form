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
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('url')->nullable()->default('https://google.com');
            $table->string('footer')->nullable()->default('Demo Footer. All rights reserved.');
            $table->dateTime('close')->nullable()->default('2024-09-28 00:00:00');
            $table->string('name')->nullable()->default('Demo App For Testing');
            $table->string('amount')->nullable()->default('10000');
            $table->string('logo')->nullable()->default('logo.png');
            $table->string('iconbg')->nullable()->default('icon_bg.png');
            $table->string('background')->nullable()->default('background.jpg');
            $table->string('favicon')->nullable()->default('favicon.ico');
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
        Schema::dropIfExists('themes');
    }
};
