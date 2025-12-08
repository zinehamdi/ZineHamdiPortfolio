import defaultTheme from 'tailwindcss/defaultTheme'
import plugin from 'tailwindcss/plugin'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './app/View/Components/**/*.php',
    './storage/framework/views/*.php',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        // Existing brand palette
        brand: {
          dark: '#050505',
          primary: '#0a0f0d',
          secondary: '#121614',
          accent: '#00FF88',
          gold: '#d4af37',
          text: '#e8e8e8',
          muted: '#888888',
        },
        // Metallic Laser system (mapped to CSS variables)
        mlp: {
          bg: {
            base: 'var(--mlp-bg-base)',
            elevated: 'var(--mlp-bg-elevated)',
            soft: 'var(--mlp-bg-elevated-soft)',
            glass: 'var(--mlp-bg-glass)',
          },
          metal: {
            dark: 'var(--mlp-metal-dark)',
            mid: 'var(--mlp-metal-mid)',
            light: 'var(--mlp-metal-light)',
          },
          gold: {
            soft: 'var(--mlp-gold-soft)',
            DEFAULT: 'var(--mlp-gold)',
            strong: 'var(--mlp-gold-strong)',
          },
          laser: {
            green: 'var(--mlp-laser-green)',
            blue: 'var(--mlp-laser-blue)',
            purple: 'var(--mlp-laser-purple)',
            pink: 'var(--mlp-laser-pink)',
          },
          text: {
            main: 'var(--mlp-text-main)',
            muted: 'var(--mlp-text-muted)',
          },
          border: {
            subtle: 'var(--mlp-border-subtle)',
          },
        },
      },
      backgroundImage: {
        'gradient-main': 'linear-gradient(to bottom, #050505, #0a0f0d)',
        'gradient-gold': 'linear-gradient(135deg, #d4af37 0%, #00FF88 100%)',
        'glass-gradient': 'linear-gradient(145deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.01) 100%)',
      },
      boxShadow: {
        'mlp-soft': 'var(--mlp-shadow-soft)',
        'mlp-strong': 'var(--mlp-shadow-strong)',
        'mlp-gold': 'var(--mlp-shadow-gold)',
        'mlp-laser-green': 'var(--mlp-shadow-laser-green)',
        'mlp-laser-blue': 'var(--mlp-shadow-laser-blue)',
        'mlp-laser-purple': 'var(--mlp-shadow-laser-purple)',
      },
      borderRadius: {
        'mlp-xs': 'var(--mlp-radius-xs)',
        'mlp-sm': 'var(--mlp-radius-sm)',
        'mlp-md': 'var(--mlp-radius-md)',
        'mlp-lg': 'var(--mlp-radius-lg)',
        'mlp-xl': 'var(--mlp-radius-xl)',
        'mlp-2xl': 'var(--mlp-radius-2xl)',
        'mlp-pill': 'var(--mlp-radius-pill)',
      },
      backdropBlur: {
        'mlp-glass': 'var(--mlp-glass-backdrop-blur)',
      },
      animation: {
        float: 'float 6s ease-in-out infinite',
        tilt: 'tilt 10s infinite linear',
        'pulse-glow': 'pulse-glow 3s ease-in-out infinite',
        shimmer: 'shimmer 2s linear infinite',
      },
      keyframes: {
        float: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-20px)' },
        },
        tilt: {
          '0%, 100%': { transform: 'rotate(-1deg)' },
          '50%': { transform: 'rotate(1deg)' },
        },
        'pulse-glow': {
          '0%, 100%': { boxShadow: '0 0 20px rgba(0, 255, 136, 0.1)' },
          '50%': { boxShadow: '0 0 40px rgba(0, 255, 136, 0.3)' },
        },
        shimmer: {
          '0%': { backgroundPosition: '-200% 0' },
          '100%': { backgroundPosition: '200% 0' },
        },
      },
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
        display: ['Space Grotesk', ...defaultTheme.fontFamily.sans],
        mono: ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
      },
    },
  },
  plugins: [
    plugin(function ({ addUtilities, addComponents, theme }) {
      const utilities = {
        '.mlp-bg-root': {
          '@apply text-mlp-text-main': {},
          background:
            'radial-gradient(circle at 0% 0%, rgba(63,210,255,0.12), transparent 62%),' +
            'radial-gradient(circle at 100% 0%, rgba(177,92,255,0.11), transparent 58%),' +
            'radial-gradient(circle at 0% 100%, rgba(43,247,159,0.08), transparent 55%),' +
            'linear-gradient(135deg, #020308 0%, #020308 32%, #050814 100%)',
        },
        '.mlp-bg-metal': {
          background:
            'linear-gradient(135deg, #050814 0%, #070b12 25%, #151823 54%, #080b13 100%)',
        },
        '.mlp-bg-panel': {
          background:
            'radial-gradient(circle at 10% 0%, rgba(249,217,143,0.12), transparent 60%),' +
            'linear-gradient(145deg, #050814 0%, #050814 35%, #0a0f1c 100%)',
        },
        '.mlp-glass': {
          background:
            'linear-gradient(135deg, rgba(255,255,255,0.06), rgba(15,23,42,0.78))',
          borderRadius: 'var(--mlp-radius-xl)',
          border: 'var(--mlp-glass-border)',
          boxShadow: 'var(--mlp-shadow-soft)',
          backdropFilter: 'blur(var(--mlp-glass-backdrop-blur))',
          WebkitBackdropFilter: 'blur(var(--mlp-glass-backdrop-blur))',
        },
        '.mlp-card': {
          background:
            'radial-gradient(circle at 0% 0%, rgba(63,210,255,0.08), transparent 55%),' +
            'radial-gradient(circle at 100% 0%, rgba(177,92,255,0.10), transparent 55%),' +
            'linear-gradient(150deg, #050814, #101524)',
          borderRadius: 'var(--mlp-radius-xl)',
          border: '1px solid rgba(148,163,184,0.35)',
          boxShadow: 'var(--mlp-shadow-soft)',
        },
        '.mlp-card-strong': {
          background:
            'radial-gradient(circle at 0% 0%, rgba(249,217,143,0.16), transparent 60%),' +
            'linear-gradient(145deg, #050814, #111827)',
          borderRadius: 'var(--mlp-radius-xl)',
          border: '1px solid rgba(249,217,143,0.65)',
          boxShadow: 'var(--mlp-shadow-strong), var(--mlp-shadow-gold)',
        },
        '.mlp-border-metal': { border: 'var(--mlp-border-metal)' },
        '.mlp-border-metal-strong': { border: 'var(--mlp-border-metal-strong)' },
        '.mlp-border-gold': { border: 'var(--mlp-border-gold)' },
        '.mlp-border-laser': {
          borderImage:
            'linear-gradient(120deg, var(--mlp-laser-green), var(--mlp-laser-blue), var(--mlp-laser-purple)) 1',
          borderWidth: '1px',
          borderStyle: 'solid',
        },
        '.mlp-glow-gold': { boxShadow: theme('boxShadow.mlp-gold') },
        '.mlp-glow-laser-green': { boxShadow: theme('boxShadow.mlp-laser-green') },
        '.mlp-glow-laser-blue': { boxShadow: theme('boxShadow.mlp-laser-blue') },
        '.mlp-glow-laser-purple': { boxShadow: theme('boxShadow.mlp-laser-purple') },
        '.mlp-laser-beam': { position: 'relative', overflow: 'visible' },
        '.mlp-laser-orbit': { position: 'relative' },
        '.mlp-metal-sheen': { position: 'relative', overflow: 'hidden' },
        '.mlp-radius-md': { borderRadius: 'var(--mlp-radius-md)' },
        '.mlp-radius-lg': { borderRadius: 'var(--mlp-radius-lg)' },
        '.mlp-radius-xl': { borderRadius: 'var(--mlp-radius-xl)' },
        '.mlp-radius-pill': { borderRadius: 'var(--mlp-radius-pill)' },
      }

      const pseudo = {
        '.mlp-laser-beam::before': {
          content: "''",
          position: 'absolute',
          inset: 'auto 0 0 0',
          height: '2px',
          background:
            'linear-gradient(90deg, transparent 0%, rgba(63,210,255,0.0) 4%, rgba(63,210,255,1) 25%, rgba(177,92,255,1) 50%, rgba(43,247,159,1) 75%, rgba(43,247,159,0.0) 96%, transparent 100%)',
          filter: 'blur(0.5px)',
          boxShadow:
            '0 0 10px rgba(63,210,255,0.8), 0 0 18px rgba(177,92,255,0.8), 0 0 24px rgba(43,247,159,0.7)',
        },
        '.mlp-laser-orbit::before': {
          content: "''",
          position: 'absolute',
          inset: '-1px',
          borderRadius: 'inherit',
          border: '1px solid transparent',
          background:
            'radial-gradient(circle at 0% 0%, rgba(63,210,255,0.0), transparent 55%),' +
            'conic-gradient(from 0deg, rgba(43,247,159,0.0), rgba(43,247,159,0.8), rgba(63,210,255,0.8), rgba(177,92,255,0.9), rgba(255,92,207,0.9), rgba(43,247,159,0.0))',
          WebkitMask:
            'linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0)',
          WebkitMaskComposite: 'xor',
          maskComposite: 'exclude',
          padding: '1px',
          opacity: '0.95',
          pointerEvents: 'none',
        },
        '.mlp-metal-sheen::before': {
          content: "''",
          position: 'absolute',
          inset: '-40%',
          background:
            'linear-gradient(120deg, transparent 10%, rgba(255,255,255,0.18) 40%, rgba(255,255,255,0.02) 60%, transparent 90%)',
          mixBlendMode: 'screen',
          opacity: '0.75',
        },
      }

      const components = {
        '.mlp-btn-gold': {
          background: 'radial-gradient(circle at 0% 0%, #fffbeb, #f9d98f)',
          color: '#18181b',
          borderRadius: 'var(--mlp-radius-pill)',
          boxShadow:
            '0 14px 30px rgba(0,0,0,0.6), 0 0 18px rgba(249,217,143,0.7)',
          border: '1px solid rgba(250,204,21,0.7)',
          fontWeight: '600',
        },
        '.mlp-btn-gold:hover': {
          background: 'radial-gradient(circle at 0% 0%, #ffffff, #ffea9f)',
          boxShadow:
            '0 20px 45px rgba(0,0,0,0.8), 0 0 24px rgba(249,217,143,0.9)',
        },
        '.mlp-btn-laser': {
          background: 'radial-gradient(circle at 0% 0%, #3fd2ff, #2bf79f)',
          color: '#020617',
          borderRadius: 'var(--mlp-radius-pill)',
          border: '1px solid rgba(148,255,215,0.85)',
          boxShadow:
            '0 0 20px rgba(63,210,255,0.7), 0 0 42px rgba(43,247,159,0.9)',
          fontWeight: '600',
        },
        '.mlp-btn-laser:hover': {
          background: 'radial-gradient(circle at 0% 0%, #5fe0ff, #58ffc2)',
        },
      }

      addUtilities(utilities)
      addUtilities(pseudo, ['responsive', 'hover'])
      addComponents(components)
    }),
  ],
}
