import gsap from 'gsap'

document.addEventListener('DOMContentLoaded', () => {
  const heroSection = document.querySelector('section#home.mlp-bg-root')
  if (!heroSection) return

  const tl = gsap.timeline({ defaults: { ease: 'power3.out' } })
  const animatedBlocks = heroSection.querySelectorAll('[data-animate]')

  if (animatedBlocks.length) {
    tl.from(animatedBlocks, {
      opacity: 0,
      y: 28,
      duration: 0.9,
      stagger: 0.08,
    })
  }

  const ctaButtons = heroSection.querySelectorAll('.mlp-btn-gold, .mlp-btn-laser')
  if (ctaButtons.length) {
    gsap.to(ctaButtons, {
      boxShadow:
        '0 0 22px rgba(249,217,143,0.65), 0 0 40px rgba(63,210,255,0.45)',
      duration: 2.6,
      repeat: -1,
      yoyo: true,
      ease: 'sine.inOut',
    })
  }

  const laserBeam = heroSection.querySelector('.mlp-laser-beam')
  if (laserBeam) {
    const sheen = document.createElement('div')
    sheen.className =
      'absolute inset-y-[-10px] w-16 bg-gradient-to-b from-transparent via-mlp-laser-blue/60 to-transparent'
    laserBeam.appendChild(sheen)

    gsap.fromTo(
      sheen,
      { xPercent: -150 },
      {
        xPercent: 150,
        duration: 3.4,
        repeat: -1,
        ease: 'power1.inOut',
      }
    )
  }

  const sheenTargets = heroSection.querySelectorAll('.mlp-metal-sheen')
  sheenTargets.forEach((el) => {
    gsap.to(el, {
      rotationY: 3,
      duration: 8,
      repeat: -1,
      yoyo: true,
      ease: 'sine.inOut',
      transformPerspective: 600,
      transformOrigin: 'center center',
    })
  })
})
