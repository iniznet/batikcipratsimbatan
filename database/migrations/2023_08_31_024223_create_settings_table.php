<?php

use App\Models\Management\Settings;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->json('value')->nullable();
            $table->string('type')->default('text');
            $table->json('attributes')->nullable();
            $table->timestamps();
        });

        Settings::create([
            'key' => 'logo',
            'type' => 'curator',
        ]);

        Settings::create([
            'key' => 'site_title',
            'value' => 'Batik Ciprat Langitan',
            'type' => 'text',
        ]);

        Settings::create([
            'key' => 'tagline',
            'value' => 'Menyatukan dan Mengembangkan Para Difabel',
            'type' => 'textarea',
        ]);

        Settings::create([
            'key' => 'description',
            'value' => 'adalah sebuah komunitas yang bergerak di bidang batik diperuntukkan bagi masyarakat difabel.',
            'type' => 'textarea',
        ]);

        Settings::create([
            'key' => 'whatsapp_numbers',
            'type' => 'repeater',
            'attributes' => [
                'columns' => [
                    [
                        'key' => 'name',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'phone',
                        'type' => 'phone',
                    ],
                ],
            ],
        ]);

        Settings::create([
            'key' => 'primary_navigation',
            'type' => 'menu',
        ]);

        Settings::create([
            'key' => 'footer_navigation_1',
            'type' => 'menu',
        ]);

        Settings::create([
            'key' => 'footer_navigation_2',
            'type' => 'menu',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
