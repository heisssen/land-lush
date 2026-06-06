# DESIGN.md — BrowsReligion

> Dark Luxury Beauty · Lead-Gen Landing Page · L2 Interactive

---

## 1. Visual Theme & Atmosphere

**Design Philosophy:** High-fashion editorial meets devoted craft. "BrowsReligion" is a bold name — the design must earn it. Deep, near-black backgrounds punctuated by warm gold and champagne accents. Every element is intentional, unhurried, premium.

**Atmosphere Keywords:** ritual · devotion · luxury · editorial · warm dark · precision · golden hour

**One-line direction:** A brow studio that feels like a high-fashion atelier — dark, warm, irreplaceable.

**Closest seed:** Dark Tech palette + Cream Editorial typography + Organic Natural warmth.

---

## 2. Color Palette & Roles

```css
:root {
  /* Backgrounds */
  --bg:          #080605;
  --bg-rgb:      8, 6, 5;
  --surface:     #130E0C;
  --surface-rgb: 19, 14, 12;
  --surface-2:   #1E1714;
  --surface-2-rgb: 30, 23, 20;

  /* Brand Gold */
  --gold:        #C9A96E;
  --gold-rgb:    201, 169, 110;
  --gold-light:  #E2C98A;
  --gold-light-rgb: 226, 201, 138;
  --gold-dim:    #7A6340;
  --gold-dim-rgb: 122, 99, 64;

  /* Rose accent */
  --rose:        #C4847A;
  --rose-rgb:    196, 132, 122;

  /* Text */
  --text:        #F2EDE8;
  --text-rgb:    242, 237, 232;
  --text-muted:  #8A7E74;
  --text-muted-rgb: 138, 126, 116;
  --text-faint:  #4A4038;
  --text-faint-rgb: 74, 64, 56;

  /* Borders */
  --border:      rgba(201, 169, 110, 0.12);
  --border-strong: rgba(201, 169, 110, 0.30);
  --border-soft: rgba(242, 237, 232, 0.06);

  /* Semantic */
  --error:       #E05C5C;
  --success:     #6ABF8A;
}
```

---

## 3. Typography Rules

```
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500;600&family=Cormorant:ital,wght@1,300&display=swap');

heading-display: Cormorant Garamond, "Georgia", serif  (wght 300-600)
heading-serif:   Cormorant Garamond, serif              (wght 400-600)
body:            DM Sans, -apple-system, sans-serif     (wght 300-600)
accent-italic:   Cormorant Garamond italic, serif       (wght 300)
```

| Token      | Size    | Weight | Line-height | Letter-spacing |
|------------|---------|--------|-------------|----------------|
| display-1  | clamp(4rem, 9vw, 9rem) | 300 | 0.9  | -0.02em |
| display-2  | clamp(2.8rem, 6vw, 6rem) | 300 | 1.0 | -0.015em |
| h1         | clamp(2rem, 4vw, 3.5rem) | 400 | 1.1 | -0.01em |
| h2         | clamp(1.6rem, 3vw, 2.4rem) | 400 | 1.2 | -0.01em |
| h3         | clamp(1.2rem, 2vw, 1.6rem) | 500 | 1.3 | 0 |
| body-lg    | 1.0625rem | 400 | 1.75 | 0.01em |
| body       | 0.9375rem | 400 | 1.7  | 0.01em |
| label      | 0.75rem   | 600 | 1.2  | 0.12em (uppercase) |
| caption    | 0.8125rem | 400 | 1.5  | 0.03em |

**Forbidden fonts:** System UI as heading, Roboto, all decorative display fonts not listed.

---

## 4. Component Stylings

### CTA Button — Primary
```css
.btn-primary {
  background: var(--gold);
  color: var(--bg);
  font: 600 0.875rem/1 'DM Sans', sans-serif;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  padding: 1rem 2.25rem;
  border: 1px solid var(--gold);
  border-radius: 2px;
  cursor: pointer;
  transition: background 0.25s, color 0.25s, transform 0.2s;
}
.btn-primary:hover  { background: var(--gold-light); border-color: var(--gold-light); transform: translateY(-1px); }
.btn-primary:active { transform: translateY(0); background: var(--gold-dim); }
.btn-primary:focus-visible { outline: 2px solid var(--gold); outline-offset: 3px; }
.btn-primary:disabled { opacity: 0.4; cursor: not-allowed; transform: none; }
```

### CTA Button — Ghost
```css
.btn-ghost {
  background: transparent;
  color: var(--gold);
  border: 1px solid var(--border-strong);
  /* same sizing as primary */
  transition: background 0.25s, border-color 0.25s;
}
.btn-ghost:hover  { background: rgba(var(--gold-rgb), 0.08); border-color: var(--gold); }
.btn-ghost:active { background: rgba(var(--gold-rgb), 0.15); }
.btn-ghost:focus-visible { outline: 2px solid var(--gold); outline-offset: 3px; }
.btn-ghost:disabled { opacity: 0.4; cursor: not-allowed; }
```

### Service Card
```css
.card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 4px;
  padding: 2rem;
  transition: border-color 0.3s, transform 0.3s, box-shadow 0.3s;
}
.card:hover {
  border-color: var(--border-strong);
  transform: translateY(-4px);
  box-shadow: 0 12px 40px rgba(var(--gold-rgb), 0.08), 0 0 0 1px rgba(var(--gold-rgb), 0.06);
}
```

### Form Input
```css
.form-input {
  background: var(--surface);
  border: 1px solid var(--border-soft);
  border-radius: 2px;
  color: var(--text);
  padding: 0.875rem 1rem;
  font: 400 0.9375rem 'DM Sans', sans-serif;
  width: 100%;
  transition: border-color 0.2s, box-shadow 0.2s;
}
.form-input:hover  { border-color: var(--border); }
.form-input:focus  { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(var(--gold-rgb), 0.12); outline: none; }
.form-input:disabled { opacity: 0.5; cursor: not-allowed; }
.form-input.error  { border-color: var(--error); }
```

### Navigation
```css
/* Default */
.nav { position: fixed; top: 0; width: 100%; padding: 1.5rem 0; transition: all 0.35s; z-index: 100; }
/* Scrolled */
.nav.scrolled { background: rgba(var(--bg-rgb), 0.92); backdrop-filter: blur(12px); padding: 1rem 0; border-bottom: 1px solid var(--border); }
/* Link */
.nav-link { color: var(--text-muted); font: 500 0.8125rem 'DM Sans'; letter-spacing: 0.08em; text-transform: uppercase; transition: color 0.2s; }
.nav-link:hover { color: var(--gold); }
.nav-link:focus-visible { outline: 2px solid var(--gold); }
```

---

## 5. Layout Principles

```
Container max-width: 1200px (gutter 2rem → 1.5rem mobile)
Grid: 12 columns, gap 1.5rem
Spacing scale: 4, 8, 12, 16, 24, 32, 48, 64, 96, 128, 160px
Section padding: 6rem 0 (desktop) → 4rem 0 (mobile)
```

---

## 6. Depth & Elevation

```
Level 0 (bg):     no shadow
Level 1 (cards):  0 2px 8px rgba(0,0,0,0.4)
Level 2 (hover):  0 12px 40px rgba(var(--gold-rgb),0.08), 0 4px 16px rgba(0,0,0,0.5)
Level 3 (modals): 0 24px 64px rgba(0,0,0,0.7)
Gold glow:        0 0 40px rgba(var(--gold-rgb),0.15)
```

---

## 7. Animation & Interaction — L2

```js
/* Scroll reveal — IntersectionObserver */
threshold: 0.15, rootMargin: '0px 0px -60px 0px'
enter: opacity 0→1, translateY 24px→0, duration 0.7s ease-out, stagger 0.1s

/* Nav scroll transition */ — scrollY > 60
/* Hero text — staggered word reveal */ — CSS animation, delay steps
/* Service cards hover */ — translateY -4px + gold glow
/* CTA button hover */ — translateY -1px
/* Booking form — field focus gold outline */
/* Number counter — IntersectionObserver trigger */
/* Gold shimmer on hero title */ — background-position animation
```

`prefers-reduced-motion`: all animations → instant (transition-duration: 0.01ms).

---

## 8. Do's and Don'ts

**DO:**
- Use Cormorant Garamond for all headings — it carries the luxury brand voice
- Keep line lengths 60-75ch for body text
- Use gold sparingly — it loses power when overused
- Every section needs white space breathing room
- CTAs must be above the fold and repeated at section breaks

**DON'T:**
- Don't use pure white `#FFFFFF` — always use `var(--text)` warm white
- Don't use more than 2 font weights per section
- Don't put gold text on gold backgrounds — contrast failure
- Don't use `filter: blur()` on animated elements
- Don't animate more than 6 elements simultaneously
- Don't use decorative emoji in headings
- Don't use border-radius > 8px for cards in dark luxury style
- Don't place CTAs without surrounding context — always pair with value proposition

---

## 9. Responsive Behavior

| Breakpoint | Width   | Changes |
|------------|---------|---------|
| mobile     | < 640px | Single column, hero font clamp min, nav hamburger |
| tablet     | 640-1024px | 2-col grid, reduced padding |
| desktop    | > 1024px | Full 3-col, all effects enabled |

- Touch targets ≥ 44×44px on mobile
- Horizontal overflow: hidden on body
- Nav collapses to hamburger at < 768px
- Booking form single-column on mobile
