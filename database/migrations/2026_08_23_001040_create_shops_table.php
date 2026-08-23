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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('district')->nullable();
            $table->string('address')->nullable();
            $table->string('description');
            $table->text('body')->nullable();
            $table->unsignedTinyInteger('rating')->nullable();
            $table->enum('status', ['want_to_visit', 'visited'])->default('want_to_visit');
            $table->boolean('is_featured')->default(false);
            $table->date('visited_at')->nullable();
            $table->string('website')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
