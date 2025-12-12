// tailwind.config.js
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './resources/**/*.ts', // If you're using TypeScript, add this
  ],
  theme: {
    extend: {
        fontFamily: {
            sans: ['Montserrat', 'sans-serif'],
        }
    },
  },
  plugins: [],
};