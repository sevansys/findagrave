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
        'cemetery-search': '2fr 3fr auto',
        'browse-locations': 'repeat(5, minmax(250px, 1fr))',
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
