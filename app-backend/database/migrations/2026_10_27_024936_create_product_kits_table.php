<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_kits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name', 150);
            $table->string('slug', 180)->unique();
            $table->string('badge', 50)->nullable();
            $table->decimal('estimated_price', 10, 2)->nullable();
            $table->text('specs_summary');
            $table->text('description')->nullable();
            $table->string('image_url', 255)->nullable();
            $table->json('features')->nullable();
            $table->boolean('includes_installation')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_kits');
    }
};
