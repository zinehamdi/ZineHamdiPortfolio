<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text')->nullable();
            $table->string('cta')->nullable();
            $table->string('link')->nullable();
            $table->string('image_path')->nullable(); // path under public/
            $table->string('locale', 5)->nullable(); // optional per-locale promo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
