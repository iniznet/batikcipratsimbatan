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
            'type' => 'image',
        ]);

        Settings::create([
            'key' => 'site_title',
            'value' => 'Laravel Filament',
            'type' => 'text',
        ]);

        Settings::create([
            'key' => 'tagline',
            'type' => 'textarea',
        ]);

        Settings::create([
            'key' => 'description',
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
        ], [
            'key' => 'footer_navigation_1',
            'type' => 'menu',
        ], [
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
