<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->json('title');
            $table->json('subtitle');
            $table->json('features');
            $table->integer('price_monthly')->nullable();
            $table->integer('price_once')->nullable();
            $table->string('currency')->default('TND');
            $table->integer('delivery_days')->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
