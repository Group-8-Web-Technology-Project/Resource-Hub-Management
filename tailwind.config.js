/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./views/**/*.{html,js,php}"],
  darkMode: 'class',
  theme: {
    extend: {
      margin: {
        '5%': '5%',
        '10%': '10%',
      }
    },
  },
  plugins: [],
}