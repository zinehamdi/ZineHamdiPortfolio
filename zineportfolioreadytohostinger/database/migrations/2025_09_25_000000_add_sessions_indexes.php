<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Ensure sessions table has indexes optimized for MySQL (Laravel's default sessions table migration is adequate,
        // but we add composite index if not present for cleanup queries).
        if (Schema::hasTable('sessions')) {
            Schema::table('sessions', function ($table) {
                // Add an index for expired session pruning if it doesn't exist
                // Using try/catch guard because shared hosting may not allow some alterations twice
                try {
                    $table->index(['last_activity']);
                } catch (Throwable $e) {
                    // Ignore if already exists
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('sessions')) {
            Schema::table('sessions', function ($table) {
                try {
                    $table->dropIndex(['last_activity']);
                } catch (Throwable $e) {
                    // Ignore
                }
            });
        }
    }
};
