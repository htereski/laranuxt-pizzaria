<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pizza')->unique()->nullable();
            $table->integer('stock')->nullable();
            $table->decimal('price');
            $table->enum('type', ['Pizza', 'Drink', 'Food']);
            $table->enum('size', ['Small', 'Medium', 'Big'])->nullable();
            $table->enum('category', ['Clássica', 'Vegetariana', 'Gourmet', 'Especial', 'Doce'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
