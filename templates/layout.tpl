<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{$page_title|default:'BrowsReligion — Luxury Brow Studio'}</title>
  <meta name="description" content="{$page_desc|default:'Precision brow artistry. Microblading, lamination, tinting &amp; shaping. Book your appointment today.'}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>

<nav class="nav" id="nav">
  <div class="container nav-inner">
    <a href="/" class="nav-logo">
      <span class="nav-logo-main">Brows</span><span class="nav-logo-accent">Religion</span>
    </a>
    <ul class="nav-links">
      <li><a href="/#services" class="nav-link">Services</a></li>
      <li><a href="/#about" class="nav-link">About</a></li>
      <li><a href="/#testimonials" class="nav-link">Reviews</a></li>
      <li><a href="/#faq" class="nav-link">FAQ</a></li>
    </ul>
    <a href="/booking.php" class="btn-primary nav-cta">Book Now</a>
    <button class="nav-hamburger" id="hamburger" aria-label="Open menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<div class="nav-drawer" id="drawer">
  <ul>
    <li><a href="/#services" class="drawer-link">Services</a></li>
    <li><a href="/#about" class="drawer-link">About</a></li>
    <li><a href="/#testimonials" class="drawer-link">Reviews</a></li>
    <li><a href="/#faq" class="drawer-link">FAQ</a></li>
    <li><a href="/booking.php" class="btn-primary" style="display:block;text-align:center;margin-top:1.5rem">Book Now</a></li>
  </ul>
</div>

{block name="content"}{/block}

<footer class="footer">
  <div class="container footer-inner">
    <div class="footer-brand">
      <span class="nav-logo-main">Brows</span><span class="nav-logo-accent">Religion</span>
      <p>Precision brow artistry.<br>Every stroke, a devotion.</p>
    </div>
    <div class="footer-links">
      <h4>Services</h4>
      <a href="/#services">Brow Shaping</a>
      <a href="/#services">Tinting</a>
      <a href="/#services">Lamination</a>
      <a href="/#services">Microblading</a>
      <a href="/#services">Powder Brows</a>
    </div>
    <div class="footer-links">
      <h4>Studio</h4>
      <a href="/#about">About</a>
      <a href="/#testimonials">Reviews</a>
      <a href="/#faq">FAQ</a>
      <a href="/booking.php">Book Appointment</a>
    </div>
    <div class="footer-contact">
      <h4>Contact</h4>
      <p>hello@browsreligion.com</p>
      <p>+1 (555) 000-0000</p>
      <div class="footer-socials">
        <a href="#" aria-label="Instagram">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.5" fill="currentColor"/></svg>
        </a>
        <a href="#" aria-label="TikTok">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
        </a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; {$smarty.now|date_format:'%Y'} BrowsReligion. All rights reserved.</p>
    <p>Motion effects derived from <a href="https://github.com/DavidHDev/vue-bits" target="_blank" rel="noopener">vue-bits</a> by DavidHDev (MIT)</p>
  </div>
</footer>

<script src="/public/js/app.js"></script>
</body>
</html>
