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
            $table->string('locale', 10)->nullable();
            $table->string('business_type')->nullable();
            $table->json('needs')->nullable();
            $table->string('budget_range')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('package_id')->nullable()->constrained('packages')->nullOnDelete();
            $table->integer('price_estimate_min')->nullable();
            $table->integer('price_estimate_max')->nullable();
            $table->string('currency', 3)->default('TND');
            $table->foreignId('lead_stage_id')->nullable()->constrained('lead_stages')->nullOnDelete();
            $table->string('source')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('email');
            $table->index('lead_stage_id');
            $table->index('package_id');
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
