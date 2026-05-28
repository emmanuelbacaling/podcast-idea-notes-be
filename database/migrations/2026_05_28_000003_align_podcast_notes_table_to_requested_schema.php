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
            foreach (['payload', 'summary', 'date_created', 'created_at_timestamp', 'estimated_duration'] as $column) {
                if (Schema::hasColumn('podcast_notes', $column)) {
                    DB::statement(sprintf('ALTER TABLE podcast_notes DROP COLUMN `%s`', $column));
                }
            }

            if (! Schema::hasColumn('podcast_notes', 'estimatedDuration')) {
                DB::statement('ALTER TABLE podcast_notes ADD COLUMN estimatedDuration VARCHAR(255) NULL AFTER category');
            }

            DB::statement(<<<'SQL'
ALTER TABLE podcast_notes
    MODIFY title VARCHAR(255) NULL,
    MODIFY content LONGTEXT NULL,
    MODIFY category VARCHAR(255) NULL,
    MODIFY status VARCHAR(255) NULL,
    MODIFY created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    MODIFY updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
SQL);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('podcast_notes')) {
            if (Schema::hasColumn('podcast_notes', 'estimatedDuration')) {
                DB::statement('ALTER TABLE podcast_notes DROP COLUMN `estimatedDuration`');
            }

            if (! Schema::hasColumn('podcast_notes', 'payload')) {
                DB::statement('ALTER TABLE podcast_notes ADD COLUMN payload JSON NULL AFTER id');
            }

            if (! Schema::hasColumn('podcast_notes', 'summary')) {
                DB::statement('ALTER TABLE podcast_notes ADD COLUMN summary TEXT NULL AFTER content');
            }

            if (! Schema::hasColumn('podcast_notes', 'date_created')) {
                DB::statement('ALTER TABLE podcast_notes ADD COLUMN date_created VARCHAR(100) NULL AFTER summary');
            }

            if (! Schema::hasColumn('podcast_notes', 'created_at_timestamp')) {
                DB::statement('ALTER TABLE podcast_notes ADD COLUMN created_at_timestamp BIGINT NULL AFTER date_created');
            }

            if (! Schema::hasColumn('podcast_notes', 'estimated_duration')) {
                DB::statement('ALTER TABLE podcast_notes ADD COLUMN estimated_duration VARCHAR(255) NULL AFTER category');
            }
        }
    }
};