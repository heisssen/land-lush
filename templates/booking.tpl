{extends file="layout.tpl"}
{assign var="page_title" value="Book Appointment — BrowsReligion"}
{assign var="page_desc" value="Reserve your brow appointment at BrowsReligion luxury brow studio."}

{block name="content"}

<section class="booking-hero">
  <div class="hero-bg">
    <div class="hero-grain"></div>
    <div class="hero-glow hero-glow-1" style="top:-10%;right:20%"></div>
  </div>
  <div class="container booking-hero-inner">
    <p class="section-eyebrow">Reserve Your Spot</p>
    <h1 class="booking-title">Book an<br><em>Appointment</em></h1>
    <p class="booking-sub">Fill in the form and we'll confirm your slot within 24 hours.</p>
  </div>
</section>

<section class="section booking-section">
  <div class="container booking-layout">

    <!-- LEFT: Info -->
    <div class="booking-info scroll-reveal">
      <div class="booking-info-card">
        <h3>What to expect</h3>
        <ul class="booking-checklist">
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 6L9 17l-5-5"/></svg>
            Confirmation within 24 hours
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 6L9 17l-5-5"/></svg>
            Prep instructions sent by email
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 6L9 17l-5-5"/></svg>
            Free 10-min consultation included
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 6L9 17l-5-5"/></svg>
            Flexible rescheduling (48h notice)
          </li>
        </ul>
      </div>

      <div class="booking-info-card">
        <h3>Services & Pricing</h3>
        {foreach from=$services item=svc}
          <div class="booking-svc-row">
            <span>{$svc.name}</span>
            <span class="booking-svc-price">{$svc.price}</span>
          </div>
        {/foreach}
      </div>

      <div class="booking-info-card booking-contact-card">
        <h3>Questions?</h3>
        <p>hello@browsreligion.com</p>
        <p>+1 (555) 000-0000</p>
      </div>
    </div>

    <!-- RIGHT: Form -->
    <div class="booking-form-wrap scroll-reveal reveal-delay-1">

      {if $success}
        <div class="booking-success">
          <div class="success-icon">✦</div>
          <h2>You're on the list.</h2>
          <p>We'll reach out within 24 hours to confirm your appointment details.</p>
          <a href="/" class="btn-ghost" style="margin-top:1.5rem;display:inline-flex">Back to Home</a>
        </div>
      {else}

        {if $errors}
          <div class="form-error-banner">
            <p>Please fix the following:</p>
            <ul>
              {foreach from=$errors item=err}<li>{$err}</li>{/foreach}
            </ul>
          </div>
        {/if}

        <form class="booking-form" method="post" action="/booking.php" novalidate>

          <div class="form-row">
            <div class="form-group">
              <label for="first_name" class="form-label">First Name *</label>
              <input type="text" id="first_name" name="first_name" class="form-input{if $field_errors.first_name} error{/if}"
                     value="{$form.first_name|default:''}" required autocomplete="given-name" placeholder="Jane">
            </div>
            <div class="form-group">
              <label for="last_name" class="form-label">Last Name *</label>
              <input type="text" id="last_name" name="last_name" class="form-input{if $field_errors.last_name} error{/if}"
                     value="{$form.last_name|default:''}" required autocomplete="family-name" placeholder="Smith">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="email" class="form-label">Email Address *</label>
              <input type="email" id="email" name="email" class="form-input{if $field_errors.email} error{/if}"
                     value="{$form.email|default:''}" required autocomplete="email" placeholder="jane@email.com">
            </div>
            <div class="form-group">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="tel" id="phone" name="phone" class="form-input"
                     value="{$form.phone|default:''}" autocomplete="tel" placeholder="+1 (555) 000-0000">
            </div>
          </div>

          <div class="form-group">
            <label for="service" class="form-label">Service *</label>
            <select id="service" name="service" class="form-input form-select{if $field_errors.service} error{/if}" required>
              <option value="">— Select a service —</option>
              {foreach from=$services item=svc}
                <option value="{$svc.name}" {if $form.service == $svc.name}selected{elseif $preselect == $svc.name}selected{/if}>
                  {$svc.name} — {$svc.price}
                </option>
              {/foreach}
            </select>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="pref_date" class="form-label">Preferred Date *</label>
              <input type="date" id="pref_date" name="pref_date" class="form-input{if $field_errors.pref_date} error{/if}"
                     value="{$form.pref_date|default:''}" min="{$smarty.now|date_format:'%Y-%m-%d'}" required>
            </div>
            <div class="form-group">
              <label for="pref_time" class="form-label">Preferred Time *</label>
              <select id="pref_time" name="pref_time" class="form-input form-select{if $field_errors.pref_time} error{/if}" required>
                <option value="">— Select time —</option>
                {foreach from=['9:00 AM','9:30 AM','10:00 AM','10:30 AM','11:00 AM','11:30 AM','12:00 PM','12:30 PM','1:00 PM','1:30 PM','2:00 PM','2:30 PM','3:00 PM','3:30 PM','4:00 PM','4:30 PM','5:00 PM'] item=t}
                  <option value="{$t}" {if $form.pref_time == $t}selected{/if}>{$t}</option>
                {/foreach}
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="notes" class="form-label">Additional Notes</label>
            <textarea id="notes" name="notes" class="form-input form-textarea" rows="4"
                      placeholder="Any skin conditions, allergies, previous treatments, or requests…">{$form.notes|default:''}</textarea>
          </div>

          <div class="form-group form-consent">
            <label class="form-checkbox">
              <input type="checkbox" name="consent" value="1" {if $form.consent}checked{/if} required>
              <span class="checkbox-custom"></span>
              <span>I agree to the <a href="#" class="inline-link">cancellation policy</a> and consent to be contacted about my booking.</span>
            </label>
          </div>

          <button type="submit" class="btn-primary btn-large btn-full" id="submit-btn">
            <span class="btn-text">Request Appointment</span>
            <span class="btn-loading" hidden>Sending…</span>
          </button>

        </form>
      {/if}
    </div>
  </div>
</section>

{/block}
