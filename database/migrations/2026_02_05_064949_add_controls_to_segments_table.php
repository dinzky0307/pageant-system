<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('segments', function (Blueprint $table) {
            if (!Schema::hasColumn('segments', 'display_order')) {
                $table->unsignedInteger('display_order')->default(1);
            }
            if (!Schema::hasColumn('segments', 'gender_scope')) {
                $table->enum('gender_scope', ['male', 'female', 'both'])->default('both');
            }
            if (!Schema::hasColumn('segments', 'is_final')) {
                $table->boolean('is_final')->default(false);
            }
            if (!Schema::hasColumn('segments', 'is_open')) {
                $table->boolean('is_open')->default(false);
            }
            if (!Schema::hasColumn('segments', 'is_locked')) {
                $table->boolean('is_locked')->default(false);
            }
            if (!Schema::hasColumn('segments', 'visible_to_judges')) {
                $table->boolean('visible_to_judges')->default(false);
            }
        });
    }

    public function down(): void
    {
        // Keep down empty to avoid dropping in dev accidentally
    }
};
