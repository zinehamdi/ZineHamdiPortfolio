<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // No-op duplicate migration. The leads table is created in a later migration.
    }

    public function down(): void
    {
        // Do nothing
    }
};
