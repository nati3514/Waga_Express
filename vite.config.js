import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/sass/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    optimizeDeps: {
        include: [
            "laravel-echo", // Add any other dependencies that need to be optimized
            "socket.io-client",
        ],
    },
});
