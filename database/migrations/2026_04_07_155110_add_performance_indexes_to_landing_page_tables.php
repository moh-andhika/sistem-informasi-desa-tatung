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
        Schema::table('beritas', function (Blueprint $table) {
            $table->index(['is_published', 'published_at']);
        });

        Schema::table('pengumumen', function (Blueprint $table) {
            $table->index(['is_active', 'published_at']);
            $table->index(['is_active', 'is_running_text', 'published_at'], 'pengumuman_running_text_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropIndex(['is_published', 'published_at']);
        });

        Schema::table('pengumumen', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'published_at']);
            $table->dropIndex('pengumuman_running_text_index');
        });
    }
};
