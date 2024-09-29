/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.tsx',
    './resources/**/*.vue',
    './resources/**/*.ts',
  ],
  theme: {
    extend: {
      gridTemplateColumns: {
        '2|3|auto': '2fr 3fr auto',
      },
    },
  },
  plugins: [],
  safelist: [
    'pt-2',
    'bg-red-100',
    'outline-none',
    'border-red-600',
    'border-neutral-500',
  ],
};
