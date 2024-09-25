/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.tsx',
    './resources/**/*.vue',
    './resources/**/*.ts',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
  safelist: ['pt-2', 'outline-none'],
};
