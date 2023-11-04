<?php

use App\Models\Homepage\Settings;
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
        Schema::create('homepage_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->json('value')->nullable();
            $table->string('type')->default('text');
            $table->json('attributes')->nullable();
            $table->timestamps();
        });

        Settings::create([
            'key' => 'home_featured_images',
            'type' => 'curator_multiple',
        ]);

        Settings::create([
            'key' => 'home_video_url',
            'type' => 'url',
        ]);

        Settings::create([
            'key' => 'home_socials',
            'type' => 'repeater',
            'attributes' => [
                'columns' => [
                    [
                        'key' => 'name',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'link',
                        'type' => 'text',
                    ],
                ],
            ],
        ]);

        Settings::create([
            'key' => 'home_about_title',
            'value' => 'Kami merupakan sebuah komunitas pembatik yang berdedikasi untuk mengangkat kreativitas difabel melalui seni tradisional pembatikan.',
            'type' => 'textarea',
        ]);

        Settings::create([
            'key' => 'home_about_image',
            'type' => 'curator',
        ]);

        Settings::create([
            'key' => 'home_about_desc',
            'value' => 'Yang paling penting adalah kami memotivasi para difabel untuk tumbuh dan berbagi pengalaman, ide, dan inspirasi mereka satu sama lain, menjadi bahagia dan efisien secara umum dalam kehidupan.',
            'type' => 'textarea',
        ]);

        Settings::create([
            'key' => 'home_about_tagline',
            'value' => 'Kami membangun sebuah komunitas yang bertanggung jawab',
            'type' => 'text',
        ]);

        Settings::create([
            'key' => 'home_activity_title',
            'value' => 'Aktivitas sehari-hari',
            'type' => 'textarea',
        ]);

        Settings::create([
            'key' => 'home_catalog_title',
            'value' => 'Produk unggulan kami',
            'type' => 'textarea',
        ]);

        Settings::create([
            'key' => 'home_catalog_desc',
            'value' => 'Eksplorasi seni dan keindahan produk-produk unggulan karya pembatik difabel',
            'type' => 'textarea',
        ]);

        Settings::create([
            'key' => 'home_catalog_iframe_url',
            'type' => 'text',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_settings');
    }
};
