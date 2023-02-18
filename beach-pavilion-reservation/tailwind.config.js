/** @type {import('tailwindcss').Config} */
module.exports = {
  mode: 'jit',
  content: ["./*.{html,php}", "./admin/*.php"],
  theme: {
    screens: {
      xs: '480px',
      sm: '576px',
      md: '768px',
      lg: '992px',
      xl: '1200px',
      xxl: '1400px',
      xxxl: '1600px',
      mobile: {
        'max': '767px'
      },
      mdOnly: {
        'min': '768px',
        'max': '991px'
      }
    },
    extend: {
      colors: {
        'dlnrgreen': {
          'lighter': '#87AD8D',
          'main': '#44804C',
          'darker': '#325f38',
        },
        'dlnrpurple': {
          1: '#804478',
          2: '#996993',
          3: '#b28eae'
        },
        'dfw-blue': {
          'main': '#275688'
        },
        'fadeBlack': 'rgba(0, 0, 0, 0.7)',
        'facebook': '#1877F2',
        'twitter': '#1DA1F2',
        'instagram': '#BD3381',
        'youtube': '#FF0000',
        'whatsapp': '#25d366'
      },
      fontFamily: {
        'vollkorn': "'Vollkorn', serif"
      }
    },
  },
  plugins: [],
}