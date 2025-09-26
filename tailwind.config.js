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
        // Premium Green Palette
        primary: {
          50: '#f4f7f2',
          100: '#e8efe4',
          200: '#d1dfc9',
          300: '#b3c9a5',
          400: '#8fab79',
          500: '#68875A', // Main Green
          600: '#537048',
          700: '#425a3a',
          800: '#364931',
          900: '#304F27', // Dark Green
          950: '#1a2b15',
        },
        // Premium Gold Palette  
        secondary: {
          50: '#fefdf9',
          100: '#fdfaf2',
          200: '#fbf3dc',
          300: '#f8e9c0',
          400: '#f4da95',
          500: '#F8C42E', // Bright Gold
          600: '#E3B43C', // Main Gold
          700: '#c69632',
          800: '#a47b2b',
          900: '#876526',
          950: '#4a3614',
        },
        accent: {
          50: '#fefaf5',
          100: '#fdf2e9',
          200: '#fae1c7',
          300: '#f6ca9f',
          400: '#f0a868',
          500: '#ea8c3e',
          600: '#d97706',
          700: '#b45309',
          800: '#92400e',
          900: '#78350f',
          950: '#451a03',
        },
        earth: {
          50: '#faf8f3',
          100: '#f4f0e6',
          200: '#e8dcc6',
          300: '#d9c49f',
          400: '#c8a878',
          500: '#b8935a',
          600: '#a6804e',
          700: '#8a6a42',
          800: '#70563a',
          900: '#5c4732',
          950: '#312419',
        }
      }
    },
  },
  plugins: [],
}
