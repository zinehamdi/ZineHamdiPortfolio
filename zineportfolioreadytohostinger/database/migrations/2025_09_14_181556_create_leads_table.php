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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('locale')->default('ar');
            $table->string('business_type')->nullable();
            $table->boolean('need_website');
            $table->boolean('need_content');
            $table->boolean('need_ai');
            $table->boolean('need_seo');
            $table->string('budget_range')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('package_id')->nullable()->constrained('packages')->nullOnDelete();
            $table->integer('price_estimate_min')->nullable();
            $table->integer('price_estimate_max')->nullable();
            $table->string('currency')->default('TND');
            $table->string('stage')->default('new');
            $table->string('source')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
