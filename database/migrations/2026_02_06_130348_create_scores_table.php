<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();

            $table->foreignId('contestant_id')->constrained()->onDelete('cascade');
            $table->foreignId('segment_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // judge

            $table->decimal('score', 4, 1); // 1.0 to 10.0 one decimal

            $table->timestamps();

            $table->unique(['contestant_id', 'segment_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
