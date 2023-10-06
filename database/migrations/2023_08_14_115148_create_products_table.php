<?php

use App\Models\Management\User;
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
            // @todo: future feature
            $table->boolean('featured')->default(false);

            // @todo: future feature
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('cost', 10, 2)->nullable();

            $table->timestamp('published_at')->useCurrent();
            $table->string('status')->default('draft');
            $table->json('colors')->nullable();
            $table->json('sizes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropConstrainedForeignId('author_id');
            $table->dropConstrainedForeignId('category_id');
            $table->dropConstrainedForeignId('material_id');
        });
        Schema::dropIfExists('products');
    }
};
