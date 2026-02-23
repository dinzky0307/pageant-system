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
    Schema::table('segments', function (Blueprint $table) {
        $table->unsignedInteger('display_order')->default(1);
        $table->enum('gender_scope', ['male', 'female', 'both'])->default('both');
        $table->boolean('is_final')->default(false);

        // controlled by admin
        $table->boolean('is_open')->default(false);
        $table->boolean('is_locked')->default(false);
        $table->boolean('visible_to_judges')->default(false);
    });
}

public function down(): void
{
    Schema::table('segments', function (Blueprint $table) {
        $table->dropColumn([
            'display_order',
            'gender_scope',
            'is_final',
            'is_open',
            'is_locked',
            'visible_to_judges',
        ]);
    });
}

};
