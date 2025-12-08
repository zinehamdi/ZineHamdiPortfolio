import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

document.addEventListener('DOMContentLoaded', () => {
  // Sidebar hover + active pulse
  const navLinks = Array.from(document.querySelectorAll('#sidebar .nav-link'))
  if (navLinks.length) {
    navLinks.forEach((link) => {
      link.addEventListener('mouseenter', () => {
        gsap.to(link, { scale: 1.02, duration: 0.2, ease: 'power2.out' })
      })
      link.addEventListener('mouseleave', () => {
        gsap.to(link, { scale: 1, duration: 0.25, ease: 'power2.out' })
      })
    })

    const targets = navLinks
      .map((link) => {
        const href = link.getAttribute('href') || ''
        if (!href.startsWith('#')) return null
        const section = document.querySelector(href)
        return section ? { link, section } : null
      })
      .filter(Boolean)

    const setActive = (link) => {
      navLinks.forEach((l) => l.classList.remove('active'))
      if (link) link.classList.add('active')
    }

    targets.forEach(({ link, section }) => {
      ScrollTrigger.create({
        trigger: section,
        start: 'top center',
        end: 'bottom center',
        onEnter: () => setActive(link),
        onEnterBack: () => setActive(link),
      })
    })
  }

  // General scroll reveals
  document.querySelectorAll('[data-animate]').forEach((el) => {
    gsap.from(el, {
      opacity: 0,
      y: 26,
      duration: 0.8,
      ease: 'power2.out',
      scrollTrigger: {
        trigger: el,
        start: 'top 85%',
      },
    })
  })

  // Projects grid enter + hover micro-tilt
  const projectCards = document.querySelectorAll('#projects .mlp-card')
  if (projectCards.length) {
    gsap.from(projectCards, {
      opacity: 0,
      y: 28,
      duration: 0.9,
      stagger: 0.08,
      ease: 'power3.out',
      scrollTrigger: { trigger: '#projects', start: 'top 75%' },
    })

    projectCards.forEach((card) => {
      const hoverIn = () => {
        gsap.to(card, {
          scale: 1.02,
          rotateY: 2.5,
          duration: 0.4,
          ease: 'power2.out',
          transformPerspective: 700,
        })
      }
      const hoverOut = () => {
        gsap.to(card, { scale: 1, rotateY: 0, duration: 0.45, ease: 'power2.out' })
      }
      card.addEventListener('mouseenter', hoverIn)
      card.addEventListener('mouseleave', hoverOut)
    })
  }

  // Services scroll-reactive - DISABLED to ensure all cards always visible
  // const serviceCards = document.querySelectorAll('.premium-services .mlp-card')
  // if (serviceCards.length) {
  //   gsap.from(serviceCards, {
  //     opacity: 0,
  //     y: 30,
  //     duration: 0.8,
  //     stagger: 0.12,
  //     ease: 'power2.out',
  //     scrollTrigger: {
  //       trigger: '.premium-services',
  //       start: 'top 80%',
  //     },
  //   })
  // }

  // Contact form lift
  const contactPanel = document.querySelector('#contact .mlp-card-strong')
  if (contactPanel) {
    gsap.from(contactPanel, {
      opacity: 0,
      y: 26,
      duration: 0.9,
      ease: 'power2.out',
      scrollTrigger: {
        trigger: contactPanel,
        start: 'top 85%',
      },
    })
  }
})
