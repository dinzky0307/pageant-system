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
    Schema::create('segment_submissions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('segment_id')->constrained()->onDelete('cascade');
        $table->boolean('locked')->default(false); // locked once all judges submit
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('segment_submissions');
    }
};
