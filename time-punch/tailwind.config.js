/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{html,php}", "./app/*.php"],
  theme: {
    screens: {
      'sm': '576px',
      'md': '768px',
      'lg': '992px',
      'xl': '1200px',
      '2xl': '1400px',
      '3xl': '1600px' 
    },
    extend: {},
  },
  plugins: [],
}
