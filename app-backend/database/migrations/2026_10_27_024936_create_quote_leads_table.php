<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_kit_id')->nullable()->constrained('product_kits')->onDelete('set null');
            $table->string('customer_name', 120)->nullable();
            $table->string('customer_phone', 30)->nullable();
            $table->string('property_type', 80)->nullable();
            $table->string('camera_count', 50)->nullable();
            $table->string('requires_installation', 100)->nullable();
            $table->string('extra_services', 150)->nullable();
            $table->text('message_payload')->nullable();
            $table->enum('status', ['nuevo', 'contactado', 'en_proceso', 'cerrado', 'descartado'])->default('nuevo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_leads');
    }
};
