{extends file="layout.tpl"}

{block name="content"}

<!-- ═══ HERO ═══ -->
<section class="hero" id="hero">
  <div class="hero-bg">
    <div class="hero-grain"></div>
    <div class="hero-glow hero-glow-1"></div>
    <div class="hero-glow hero-glow-2"></div>
  </div>

  <div class="container hero-inner">
    <p class="hero-eyebrow reveal-text">Brow Artistry Studio</p>
    <h1 class="hero-title">
      <span class="hero-word">Elevate</span>
      <span class="hero-word hero-word-italic">your</span>
      <span class="hero-word">Brows.</span><br>
      <span class="hero-word">Elevate</span>
      <span class="hero-word hero-word-italic">your</span>
      <span class="hero-word hero-word-gold">Life.</span>
    </h1>
    <p class="hero-sub reveal-text reveal-delay-3">
      Semi-permanent artistry and precision brow services, crafted for faces that deserve to be remembered.
    </p>
    <div class="hero-actions reveal-text reveal-delay-4">
      <a href="/booking.php" class="btn-primary btn-large">Book Your Appointment</a>
      <a href="#services" class="btn-ghost btn-large">View Services</a>
    </div>
    <div class="hero-social-proof reveal-text reveal-delay-5">
      <div class="proof-item">
        <span class="proof-num">3,200+</span>
        <span class="proof-label">Happy Clients</span>
      </div>
      <div class="proof-divider"></div>
      <div class="proof-item">
        <span class="proof-num">98%</span>
        <span class="proof-label">5-Star Reviews</span>
      </div>
      <div class="proof-divider"></div>
      <div class="proof-item">
        <span class="proof-num">7 yrs</span>
        <span class="proof-label">Studio Experience</span>
      </div>
    </div>
  </div>

  <div class="hero-scroll-hint">
    <span>Scroll</span>
    <div class="scroll-line"></div>
  </div>
</section>

<!-- ═══ MARQUEE BAND ═══ -->
<div class="marquee-band" aria-hidden="true">
  <div class="marquee-track">
    {foreach from=['Microblading','Ombre Brows','Lamination','Tinting','Shaping','Nano Brows','Combination','Precision','Artistry'] item=word}
      <span>{$word}</span><span class="marquee-sep">✦</span>
    {/foreach}
    {foreach from=['Microblading','Ombre Brows','Lamination','Tinting','Shaping','Nano Brows','Combination','Precision','Artistry'] item=word}
      <span>{$word}</span><span class="marquee-sep">✦</span>
    {/foreach}
  </div>
</div>

<!-- ═══ SERVICES ═══ -->
<section class="section" id="services">
  <div class="container">
    <div class="section-header scroll-reveal">
      <p class="section-eyebrow">The Menu</p>
      <h2 class="section-title">Our Services</h2>
      <p class="section-sub">From a quick tidy-up to a full transformation — every service is a ritual.</p>
    </div>

    <div class="services-grid">
      {foreach from=$services item=svc name=loop}
        <div class="card card-service scroll-reveal" style="--delay:{$smarty.foreach.loop.index * 0.08}s">
          <div class="card-icon">{$svc.icon}</div>
          <div class="card-top">
            <h3 class="card-title">{$svc.name}</h3>
            <div class="card-meta">
              <span class="card-price">{$svc.price}</span>
              <span class="card-sep">·</span>
              <span class="card-duration">{$svc.duration}</span>
            </div>
          </div>
          <p class="card-desc">{$svc.desc}</p>
          <a href="/booking.php?service={$svc.name|escape:'url'}" class="card-link">
            Book this service
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>
      {/foreach}
    </div>
  </div>
</section>

<!-- ═══ STATS ═══ -->
<section class="section-stats scroll-reveal">
  <div class="container stats-grid">
    {foreach from=$stats item=stat}
      <div class="stat-item">
        <span class="stat-value" data-target="{$stat.value}">{$stat.value}</span>
        <span class="stat-label">{$stat.label}</span>
      </div>
    {/foreach}
  </div>
</section>

<!-- ═══ ABOUT ═══ -->
<section class="section section-about" id="about">
  <div class="container about-inner">
    <div class="about-image-col scroll-reveal">
      <div class="about-img-wrap">
        {if $has_about_img}
          <img src="/images/about.jpg" alt="BrowsReligion Studio" loading="lazy">
        {else}
          <div class="about-img-placeholder">
            <span>BR</span>
          </div>
        {/if}
        <div class="about-badge">
          <span class="about-badge-num">7</span>
          <span class="about-badge-text">Years<br>of Craft</span>
        </div>
      </div>
    </div>
    <div class="about-text-col scroll-reveal reveal-delay-1">
      <p class="section-eyebrow">The Studio</p>
      <h2 class="section-title">Brows aren't<br><em>just beauty</em></h2>
      <p class="about-body">They frame everything. They tell the world how you feel before you speak. At BrowsReligion we treat your brows with the same devotion you bring to every other part of your life.</p>
      <p class="about-body">Founded on the belief that precision and artistry are not opposites — we've spent 7 years perfecting a method that honours your natural features while elevating them beyond what you imagined possible.</p>
      <a href="/booking.php" class="btn-primary" style="margin-top:2rem;display:inline-flex">Book a Consultation</a>
    </div>
  </div>
</section>

<!-- ═══ BOOKING CTA BAND ═══ -->
<section class="cta-band scroll-reveal">
  <div class="container cta-band-inner">
    <div>
      <h2 class="cta-band-title">Ready to begin<br><em>your ritual?</em></h2>
      <p class="cta-band-sub">Limited appointment slots available each week.</p>
    </div>
    <a href="/booking.php" class="btn-primary btn-large">Reserve My Spot</a>
  </div>
</section>

<!-- ═══ TESTIMONIALS ═══ -->
<section class="section" id="testimonials">
  <div class="container">
    <div class="section-header scroll-reveal">
      <p class="section-eyebrow">Devotees</p>
      <h2 class="section-title">What our clients say</h2>
    </div>
    <div class="testimonials-grid">
      {foreach from=$testimonials item=t name=tloop}
        <div class="testimonial-card scroll-reveal" style="--delay:{$smarty.foreach.tloop.index * 0.12}s">
          <div class="t-stars">
            {section name=star loop=$t.rating}
              <span>★</span>
            {/section}
          </div>
          <p class="t-text">"{$t.text}"</p>
          <div class="t-author">
            <span class="t-name">{$t.name}</span>
            <span class="t-service">{$t.service}</span>
          </div>
        </div>
      {/foreach}
    </div>
  </div>
</section>

<!-- ═══ FAQ ═══ -->
<section class="section" id="faq">
  <div class="container faq-inner">
    <div class="section-header scroll-reveal">
      <p class="section-eyebrow">Questions</p>
      <h2 class="section-title">Before you book</h2>
    </div>
    <div class="faq-list">
      {foreach from=$faqs item=faq name=floop}
        <div class="faq-item scroll-reveal" style="--delay:{$smarty.foreach.floop.index * 0.06}s">
          <button class="faq-question" aria-expanded="false">
            <span>{$faq.q}</span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 9l6 6 6-6"/></svg>
          </button>
          <div class="faq-answer">
            <p>{$faq.a}</p>
          </div>
        </div>
      {/foreach}
    </div>
  </div>
</section>

<!-- ═══ FINAL CTA ═══ -->
<section class="section section-final-cta scroll-reveal">
  <div class="container" style="text-align:center">
    <p class="section-eyebrow">Ready?</p>
    <h2 class="section-title" style="max-width:600px;margin:0 auto 1.5rem">Your brows. Your ritual.<br><em>Book today.</em></h2>
    <a href="/booking.php" class="btn-primary btn-large">Book an Appointment</a>
  </div>
</section>

{/block}
