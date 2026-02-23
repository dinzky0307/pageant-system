<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('segment_criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('segment_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->unsignedInteger('display_order')->default(1);
            $table->timestamps();

            $table->unique(['segment_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('segment_criteria');
    }
};
