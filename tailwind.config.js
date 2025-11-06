/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './app/View/Components/**/*.php',
    './storage/framework/views/*.php',
  ],
  theme: {
    extend: {
      colors: {
        // Requested brand palette
        brand: {
          accent: '#F5A623',
          accentDark: '#CC860E',
          ink: '#1F2937',
          black: '#0F0F0F',
          grayPanel: '#E5E7EB',
          grayBg: '#F7F7F7',
          white: '#FFFFFF',
        },
      },
      // Remove dark/blue gradients from new design language; keep previous if referenced elsewhere
      backgroundImage: {},
      fontFamily: { sans: 'var(--font-sans)' },
      borderRadius: { '2xl': '1rem', 'xl2': '1rem' },
      letterSpacing: { wide2: '.08em' },
      boxShadow: { soft: '0 8px 24px rgba(0,0,0,0.06)' },
    },
  },
  plugins: [],
}
