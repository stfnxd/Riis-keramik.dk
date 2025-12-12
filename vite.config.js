import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            // optional, you can override manifest path
            // to match your server build location
            buildDirectory: process.env.APP_PUBLIC_PATH ? path.join(process.env.APP_PUBLIC_PATH, 'build') : 'public/build',
        }),
    ],
    build: {
        outDir: process.env.APP_PUBLIC_PATH ? path.join(process.env.APP_PUBLIC_PATH, 'build') : 'public/build',
        emptyOutDir: true,
    },
});
