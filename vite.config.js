import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import ElementPlus from 'unplugin-element-plus/vite'
import Components from 'unplugin-vue-components/vite'

import vue from '@vitejs/plugin-vue';

import { ElementPlusResolver } from 'unplugin-vue-components/resolvers'
import {
    fileURLToPath,
    URL
} from 'url'

export default defineConfig({
    server: {
        // port:3000,
        hmr: {
            host: 'localhost',
            // overlay:false
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'packages/callcocam/resources/css/app.css',
                'resources/js/app.js',
                'packages/callcocam/resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        ElementPlus({
            importStyle: 'sass',
            useSource: true
        }),
        Components({
            resolvers: [ElementPlusResolver()]
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '@': fileURLToPath(new URL('./packages/callcocam/resources/js',
                import.meta.url)),
            '@laravue-menus': fileURLToPath(new URL('./packages/callcocam/laravue-menus/resources/js',
                import.meta.url)),
            '@laravue-makes': fileURLToPath(new URL('./packages/callcocam/laravue-makes/resources/js',
                import.meta.url)),
            '@file-manager': fileURLToPath(new URL('./packages/callcocam/laravue-file-manager/resources/js',
                import.meta.url)),
            '@laravue-table': fileURLToPath(new URL('./packages/callcocam/laravue-table/resources/js',
                import.meta.url)),
            '@form-manager': fileURLToPath(new URL('./packages/callcocam/laravue-form/resources/js',
                import.meta.url)),
        },
    },
});
