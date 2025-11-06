<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // No-op duplicate migration. The packages table is created later.
    }

    public function down(): void
    {
        // Do nothing
    }
};
