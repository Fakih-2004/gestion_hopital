
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs'; // <== ضروري

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
   server: {
        https: {
            key: fs.readFileSync('C:/Users/hajar/Downloads/php-8.4.4-nts-Win32-vs17-x64/extras/ssl/ssl/localhost.key'),
            cert: fs.readFileSync('C:/Users/hajar/Downloads/php-8.4.4-nts-Win32-vs17-x64/extras/ssl/ssl/localhost.crt'),
        },
        host: 'localhost',
        port: 5173,
    },
});

      