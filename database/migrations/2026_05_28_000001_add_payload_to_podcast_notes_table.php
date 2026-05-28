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
        Schema::table('podcast_notes', function (Blueprint $table): void {
            if (! Schema::hasColumn('podcast_notes', 'payload')) {
                $table->json('payload')->nullable()->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('podcast_notes', function (Blueprint $table): void {
            if (Schema::hasColumn('podcast_notes', 'payload')) {
                $table->dropColumn('payload');
            }
        });
    }
};
