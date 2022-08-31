/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        "light-blue": "#669fce",
        "dark-blue": "#b3cce6",
      },
    },
  },
  plugins: [],
};
