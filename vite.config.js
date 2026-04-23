import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/register.css',
                'resources/js/app.js',
                'resources/js/modelis.js',
                'resources/js/addlisting.js',
                'resources/js/register.js',
                'resources/js/validation.js',
                'resources/js/toggle.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
