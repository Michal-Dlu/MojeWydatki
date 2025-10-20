import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    server: {
        proxy: {
  '/api': 'http://localhost:8000', // Przekierowanie zapytań do backendu
        },
    },
     cors: {
            origin: 'http://localhost:5173', // Umożliwienie dostępu z frontendu
            methods: ['GET', 'POST', 'PUT', 'DELETE'],
            allowedHeaders: ['Content-Type', 'X-Requested-With'],
        },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/shops.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
