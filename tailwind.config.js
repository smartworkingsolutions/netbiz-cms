module.exports = {
  mode: 'jit',
  content: ["**/*.html", "**/*.php"],
  theme: {
    container: {
      center: true,
      padding: '1.5rem',
    },
    extend: {
      colors: {
        'theme-color': 'var(--color-primary)',
        'dark-color': 'var(--color-dark)',
        'dark-section-text': 'var(--color-dark-section-text)',
        'footer-bg' : 'var(--color-footer-bg)',
        'footer-text' : 'var(--color-footer-text)',
        'overlay-color' : 'var(--color-overlay)',
      },
      spacing: {
        '26': '6.5rem',
      },
      screens: {
        '2xl': '1440px',
        '3xl': '1600px',
        '4xl': '1820px',
      },
      fontSize: {
        '4.5xl': '2.75rem',
      },
      fontFamily: {
        'awesome': ['"Font Awesome 5 Pro"'],
      },
      transitionProperty: {
        'height': 'height',
        'spacing': 'margin, padding',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
