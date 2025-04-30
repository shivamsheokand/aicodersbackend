import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig(({ command, mode }) => {
    const isProduction = mode === "production";

    return {
        plugins: [
            laravel({
                input: ["resources/css/app.css", "resources/js/app.js"],
                refresh: !isProduction,
            }),
            tailwindcss(),
        ],
        build: {
            manifest: true,
            outDir: "public/build",
            rollupOptions: {
                output: {
                    manualChunks: {
                        vendor: [
                            // Add any vendor chunks here if needed
                        ],
                    },
                },
            },
            chunkSizeWarningLimit: 1000,
            minify: isProduction,
            sourcemap: !isProduction,
        },
        server: {
            https: false,
            host: true,
            strictPort: true,
            port: 5173,
            hmr: {
                host: "localhost",
            },
        },
    };
});
