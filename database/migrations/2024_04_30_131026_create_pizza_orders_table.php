<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pizza_orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('value', 5, 2);
            $table->unsignedBigInteger('pizza_id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('pizza_id')->references('id')->on('pizzas');
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('pizzas_order');
    }
};
