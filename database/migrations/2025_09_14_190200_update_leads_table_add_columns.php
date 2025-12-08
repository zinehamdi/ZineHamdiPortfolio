<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('leads')) {
            return;
        }

        Schema::table('leads', function (Blueprint $table) {
            if (!Schema::hasColumn('leads', 'needs')) {
                $table->json('needs')->nullable()->after('business_type');
            }

            if (!Schema::hasColumn('leads', 'metadata')) {
                $table->json('metadata')->nullable()->after('source');
            }

            if (!Schema::hasColumn('leads', 'lead_stage_id')) {
                $table->foreignId('lead_stage_id')->nullable()->after('currency')->constrained('lead_stages')->nullOnDelete();
            }

            if (!Schema::hasColumn('leads', 'source')) {
                $table->string('source')->nullable()->after('lead_stage_id');
            }

            if (!Schema::hasColumn('leads', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        // Intentionally left blank to avoid destructive schema changes on rollback.
    }
};
