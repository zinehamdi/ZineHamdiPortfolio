<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('leads')) {
            Schema::table('leads', function (Blueprint $table) {
                if (!Schema::hasColumn('leads', 'phone')) {
                    $table->string('phone')->nullable()->after('email');
                }
                if (!Schema::hasColumn('leads', 'company')) {
                    $table->string('company')->nullable()->after('phone');
                }
                if (!Schema::hasColumn('leads', 'locale')) {
                    $table->string('locale')->default('ar')->after('company');
                }
                if (!Schema::hasColumn('leads', 'business_type')) {
                    $table->string('business_type')->nullable()->after('locale');
                }
                if (!Schema::hasColumn('leads', 'need_website')) {
                    $table->boolean('need_website')->default(false)->after('business_type');
                }
                if (!Schema::hasColumn('leads', 'need_content')) {
                    $table->boolean('need_content')->default(false)->after('need_website');
                }
                if (!Schema::hasColumn('leads', 'need_ai')) {
                    $table->boolean('need_ai')->default(false)->after('need_content');
                }
                if (!Schema::hasColumn('leads', 'need_seo')) {
                    $table->boolean('need_seo')->default(false)->after('need_ai');
                }
                if (!Schema::hasColumn('leads', 'budget_range')) {
                    $table->string('budget_range')->nullable()->after('need_seo');
                }
                if (!Schema::hasColumn('leads', 'notes')) {
                    $table->text('notes')->nullable()->after('budget_range');
                }
                if (!Schema::hasColumn('leads', 'package_id')) {
                    $table->foreignId('package_id')->nullable()->after('notes')->constrained('packages')->nullOnDelete();
                }
                if (!Schema::hasColumn('leads', 'price_estimate_min')) {
                    $table->integer('price_estimate_min')->nullable()->after('package_id');
                }
                if (!Schema::hasColumn('leads', 'price_estimate_max')) {
                    $table->integer('price_estimate_max')->nullable()->after('price_estimate_min');
                }
                if (!Schema::hasColumn('leads', 'currency')) {
                    $table->string('currency')->default('TND')->after('price_estimate_max');
                }
                if (!Schema::hasColumn('leads', 'stage')) {
                    $table->string('stage')->default('new')->after('currency');
                }
                if (!Schema::hasColumn('leads', 'source')) {
                    $table->string('source')->nullable()->after('stage');
                }
                if (!Schema::hasColumn('leads', 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('leads')) {
            Schema::table('leads', function (Blueprint $table) {
                // No destructive down to avoid data loss; leave columns in place
            });
        }
    }
};
