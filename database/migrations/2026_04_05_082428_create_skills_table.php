<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('icon')->nullable();
            $table->string('short_desc');
            $table->text('description')->nullable();
            $table->text('install_steps')->nullable();
            $table->text('config_code')->nullable();
            $table->text('use_cases')->nullable();
            $table->text('pros')->nullable();
            $table->text('cons')->nullable();
            $table->string('author')->nullable();
            $table->string('repo_url')->nullable();
            $table->decimal('avg_rating', 3, 2)->default(0);
            $table->integer('install_count')->default(0);
            $table->integer('likes_count')->default(0);
            $table->integer('reviews_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
