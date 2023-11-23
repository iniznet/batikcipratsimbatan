import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    resolve: {
        alias: {
            '@': '/resources',
            '~': '/node_modules',
            '@styles': '/resources/css',
            '@scripts': '/resources/js',
            '@images': '/resources/img',
            '@fonts': '/resources/fonts',
            '@vendor': '/vendor',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/js/app.js',
                'resources/css/filament/admin/theme.css',
            ],
            refresh: true,
        }),
    ],
});
