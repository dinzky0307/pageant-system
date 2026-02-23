<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('criterion_scores', function (Blueprint $table) {
            $table->id();

            $table->foreignId('contestant_id')->constrained()->onDelete('cascade');
            $table->foreignId('segment_id')->constrained()->onDelete('cascade');
            $table->foreignId('criterion_id')->constrained('segment_criteria')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // judge

            $table->decimal('score', 4, 1); // 1.0 to 10.0

            $table->timestamps();

            $table->unique(['contestant_id', 'segment_id', 'criterion_id', 'user_id'], 'uniq_crit_score');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('criterion_scores');
    }
};
