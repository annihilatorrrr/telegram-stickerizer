import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import svgLoader from 'vite-svg-loader'
import i18n from 'laravel-vue-i18n/vite';
import {fileURLToPath, URL} from "url";
import {exec} from "child_process";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/css/webapp.scss',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    // The Vue plugin will re-write asset URLs, when referenced
                    // in Single File Components, to point to the Laravel web
                    // server. Setting this to `null` allows the Laravel plugin
                    // to instead re-write asset URLs to point to the Vite
                    // server instead.
                    base: null,

                    // The Vue plugin will parse absolute URLs and treat them
                    // as absolute paths to files on disk. Setting this to
                    // `false` will leave absolute URLs un-touched so they can
                    // reference assets in the public directory as expected.
                    includeAbsolute: false,
                },
            },
        }),
        svgLoader({
            defaultImport: 'url',
            svgo: false
        }),
        i18n(),
    ],
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost',
        },
        strictPort: true,
    },
    resolve: {
        alias: [
            // @ts-ignore
            { find: '@', replacement: fileURLToPath(new URL('./resources/js', import.meta.url)) },
            // @ts-ignore
            { find: '@css', replacement: fileURLToPath(new URL('./resources/css', import.meta.url)) },
        ],
    },
});
