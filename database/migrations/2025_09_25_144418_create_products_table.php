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
        $table->foreignId('category_id')->constrained()->cascadeOnDelete();
        $table->decimal('price', 10, 2);
        $table->text('description')->nullable();
        $table->decimal('width', 8, 2)->nullable();
        $table->decimal('height', 8, 2)->nullable();
        $table->integer('stock')->default(0);
        $table->decimal('weight', 8, 2)->nullable(); // in kg
        $table->boolean('featured')->default(false);
        $table->enum('availability_status', ['in_stock', 'made_to_order', 'sold_out'])
              ->default('in_stock');
        $table->json('image_path')->nullable();
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
