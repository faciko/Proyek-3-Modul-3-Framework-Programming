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
        Schema::table('activities', function (Blueprint $table) {
            $table->string('poster_path')->nullable()->after('status');
            $table->unsignedInteger('registered_count')->default(0)->after('capacity');
            $table->softDeletes();
            $table->index(['status', 'start_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropIndex(['status', 'start_at']);
            $table->dropSoftDeletes();
            $table->dropColumn(['poster_path', 'registered_count']);
        });
    }
};
