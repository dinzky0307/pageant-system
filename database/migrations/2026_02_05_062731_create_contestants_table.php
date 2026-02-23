<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contestants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->integer('number'); // contestant number (1-11)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contestants');
    }
};
