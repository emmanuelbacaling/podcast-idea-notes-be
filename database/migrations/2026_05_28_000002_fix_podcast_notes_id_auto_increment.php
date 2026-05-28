<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('podcast_notes')) {
            DB::statement('ALTER TABLE podcast_notes MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('podcast_notes')) {
            DB::statement('ALTER TABLE podcast_notes MODIFY id BIGINT UNSIGNED NOT NULL');
        }
    }
};
