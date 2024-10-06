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
        Schema::create('components', function (Blueprint $table) {
			$table->id();
			$table->string('type'); // (e.g., Snippet, Text, etc.)
			$table->foreignId('language_id')->constrained('languages')->onDelete('cascade');;
			$table->morphs('componentable'); // Polymorphic relationship to the specific component types
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
