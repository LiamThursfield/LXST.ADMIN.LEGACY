import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/landlord/app.js',
            ],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm.js',
            '@': path.resolve(__dirname, 'resources/js'),
            'zora-js': path.resolve(__dirname, 'vendor/jetstreamlabs/zora/dist/index.js'),
            zora: path.resolve(__dirname, 'vendor/jetstreamlabs/zora/dist/vue.js'),
        },
    },
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost'
        }
    }
});
