const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/**/*.php",
    "./app/View/Components/**/*.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        'title': ['"Great Vibes"', 'Carlito', ...defaultTheme.fontFamily.sans],
        'heading': ['"Moulpali"', 'Carlito', ...defaultTheme.fontFamily.sans],
        'sans': ['"Carlito"', ...defaultTheme.fontFamily.sans],
      },
      gridTemplateAreas: {
        'newsletter__dekstop': [
          'icon title form',
          'icon message form',
        ],
        'newsletter': [
          'icon title',
          'message message',
          'form form',
        ],
      },
      gridTemplateColumns: {
        'newsletter__dekstop': 'auto 1fr 1fr',
        'newsletter': 'auto 1fr',
      },
      typography: {
        DEFAULT: {
          css: {
            h1: {
              fontFamily: 'heading',
            },
            h2: {
              fontFamily: 'heading',
            },
            h3: {
              fontFamily: 'heading',
            },
            h4: {
              fontFamily: 'heading',
            },
            h5: {
              fontFamily: 'heading',
            },
            h6: {
              fontFamily: 'heading',
            },
            maxWidth: '100%',
          },
        }
      }
    },
  },
  plugins: [
    require("@tailwindcss/aspect-ratio"),
    require('@savvywombat/tailwindcss-grid-areas'),
    require('@tailwindcss/typography'),
  ],
}

