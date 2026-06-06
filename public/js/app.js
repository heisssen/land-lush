// BrowsReligion — L2 Interactive
'use strict';

// ── Nav scroll state ──
const nav = document.getElementById('nav');
if (nav) {
  let ticking = false;
  window.addEventListener('scroll', () => {
    if (!ticking) {
      requestAnimationFrame(() => {
        nav.classList.toggle('scrolled', window.scrollY > 60);
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });
}

// ── Hamburger ──
const hamburger = document.getElementById('hamburger');
const drawer    = document.getElementById('drawer');
if (hamburger && drawer) {
  hamburger.addEventListener('click', () => {
    const open = drawer.classList.toggle('open');
    hamburger.setAttribute('aria-expanded', open);
    document.body.style.overflow = open ? 'hidden' : '';
  });
  drawer.querySelectorAll('a').forEach(a => {
    a.addEventListener('click', () => {
      drawer.classList.remove('open');
      document.body.style.overflow = '';
      hamburger.setAttribute('aria-expanded', false);
    });
  });
}

// ── Scroll reveal ──
const revealEls = document.querySelectorAll('.scroll-reveal');
if (revealEls.length) {
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -50px 0px' });
  revealEls.forEach(el => io.observe(el));
}

// ── FAQ accordion ──
document.querySelectorAll('.faq-question').forEach(btn => {
  btn.addEventListener('click', () => {
    const expanded = btn.getAttribute('aria-expanded') === 'true';
    // close all
    document.querySelectorAll('.faq-question').forEach(b => {
      b.setAttribute('aria-expanded', 'false');
      b.nextElementSibling?.classList.remove('open');
    });
    // open clicked if was closed
    if (!expanded) {
      btn.setAttribute('aria-expanded', 'true');
      btn.nextElementSibling?.classList.add('open');
    }
  });
});

// ── Smooth anchor scroll ──
document.querySelectorAll('a[href^="/#"]').forEach(a => {
  a.addEventListener('click', e => {
    const id = a.getAttribute('href').slice(2);
    const el = document.getElementById(id);
    if (el) {
      e.preventDefault();
      el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});

// ── Booking form loading state ──
const bookingForm = document.querySelector('.booking-form');
if (bookingForm) {
  bookingForm.addEventListener('submit', () => {
    const btn = document.getElementById('submit-btn');
    if (!btn) return;
    btn.querySelector('.btn-text')?.setAttribute('hidden', '');
    btn.querySelector('.btn-loading')?.removeAttribute('hidden');
    btn.disabled = true;
  });
}

// ── Pre-select service from URL param ──
const urlService = new URLSearchParams(window.location.search).get('service');
if (urlService) {
  const sel = document.getElementById('service');
  if (sel) {
    [...sel.options].forEach(o => {
      if (o.value === urlService) o.selected = true;
    });
  }
}
