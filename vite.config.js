import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],

    server: {
        host: '0.0.0.0', // Позволяет Vite слушать порты вне контейнера
        hmr: {
            host: 'localhost', // Указывает браузеру искать обновления кода на локальном ПК
        },
    },
});
