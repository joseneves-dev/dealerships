import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/style.css",
                "resources/css/vendors_css.css",
                "resources/css/skin_color.css",
            ],
            refresh: true,
        }),
    ],
});
