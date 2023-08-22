<?php

use App\Models\User;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('shop_categories')->nullOnDelete();
            $table->foreignId('material_id')->nullable()->constrained('shop_materials')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->unsignedInteger('qty')->default(0);
            $table->boolean('featured')->default(false);
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('cost', 10, 2)->nullable();
            $table->timestamp('published_at')->useCurrent();
            $table->string('status')->default('draft');
            $table->json('colors')->nullable();
            $table->json('sizes')->nullable();
            $table->json('platforms')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
