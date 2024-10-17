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
      height: {
        'cemetery-map': 'calc(100vh - 60px)',
      },
    },
  },
  plugins: [],
  safelist: [
    'pt-2',
    'h-[80vh]',
    'bg-red-100',
    'outline-none',
    'border-red-600',
    'hover:bg-white',
    'hover:bg-gray-50',
    'border-neutral-500',
    'hover:border-black',
    'hover:bg-[#5C60A3]',
  ],
};
