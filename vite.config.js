import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/scss/app.scss',
        'resources/scss/pages/home.scss',
        'resources/ts/app.ts',
      ],
      refresh: true,
    }),
  ],
});
