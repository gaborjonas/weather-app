import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from "path";
import purge from "@erbelion/vite-plugin-laravel-purgecss";
export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/scss/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
        purge({
            templates: ["vue"],
        }),
    ],
    resolve: {
        alias: {
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
        },
    },
});
