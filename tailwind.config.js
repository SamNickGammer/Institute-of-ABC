/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        clifford: '#da373d',
        line: {
          'thin': '#00000017',
          'mid': '#0000004d'
        },
        ThemeBlack: '#121212',
        grayD9: '#D9D9D9',
      },
      fontFamily: {
        HellixBL: ['Hellix-Black'],
        HellixB: ['Hellix-Bold'],
        HellixEB: ['Hellix-ExtraBold'],
        HellixL: ['Hellix-Light'],
        HellixM: ['Hellix-Medium'],
        HellixR: ['Hellix-Regular'],
        HellixSB: ['Hellix-SemiBold'],
        HellixT: ['Hellix-Thin'],
      },
      screens: {
        '1000': '1000px'
      },
      borderWidth: {
        DEFAULT: '1px',
        '1': '1px',
        '4': '4px',
      },
      keyframes: {
        marquee: {
          '0%': { transform: 'translateX(0)' },
          '100%': { transform: 'translateX(-50%)' },
        },
      },
      animation: {
        marquee: 'marquee 10s linear infinite',
      },
    },
  },
  plugins: [],
}

