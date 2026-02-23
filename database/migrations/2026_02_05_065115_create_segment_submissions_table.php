<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('segment_judge_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('segment_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // judge
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();

            $table->unique(['segment_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('segment_judge_submissions');
    }
};
