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
        Schema::table('events', function (Blueprint $table) {
            // Rename title to name
            $table->renameColumn('title', 'name');

            // Rename capacity to max_participants
            $table->renameColumn('capacity', 'max_participants');

            // Add notes column
            $table->text('notes')->nullable()->after('description');

            // Update status enum values
            $table->dropColumn('status');
        });

        // Add new status column with updated values
        Schema::table('events', function (Blueprint $table) {
            $table->enum('status', ['akan datang', 'sedang berlangsung', 'selesai', 'dibatalkan'])->default('akan datang')->after('max_participants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Revert status column
            $table->dropColumn('status');
            $table->enum('status', ['draft', 'published', 'cancelled', 'completed'])->default('draft');

            // Remove notes column
            $table->dropColumn('notes');

            // Revert column names
            $table->renameColumn('name', 'title');
            $table->renameColumn('max_participants', 'capacity');
        });
    }
};
