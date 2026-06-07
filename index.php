<?php
// Lead capture handler
$lead_success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lead_name'])) {
    $lead = [
        'id'    => uniqid('L', true),
        'ts'    => date('Y-m-d H:i:s'),
        'name'  => trim(htmlspecialchars($_POST['lead_name'] ?? '')),
        'email' => trim(htmlspecialchars($_POST['lead_email'] ?? '')),
        'phone' => trim(htmlspecialchars($_POST['lead_phone'] ?? '')),
        'note'  => trim(htmlspecialchars($_POST['lead_note'] ?? '')),
        'src'   => 'website_lead_form',
    ];
    if ($lead['name'] && filter_var($lead['email'], FILTER_VALIDATE_EMAIL)) {
        $f = __DIR__ . '/data/leads.json';
        $arr = file_exists($f) ? json_decode(file_get_contents($f), true) : [];
        $arr[] = $lead;
        file_put_contents($f, json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $lead_success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrowsReligion — Brows · Lashes · PMU · Los Angeles</title>
    <meta name="description" content="Luxury brow & lash studio in Studio City, LA. Microblading, lamination, lash extensions. Book with Alena or Tanya. 4444 Lankershim Blvd, Suite 207.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        /* ─── Variables ─── */
        :root {
            --cream:   #faf7f0;
            --green:   #0d2a18;
            --gold:    #c5a880;
            --dark:    #222222;
            --muted:   #555555;
            --white:   #ffffff;
            --serif:   'Playfair Display', serif;
            --sans:    'Montserrat', sans-serif;
            --script:  'Great Vibes', cursive;
        }
        html { scroll-behavior: smooth; }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: var(--cream); color: var(--dark); font-family: var(--sans); line-height: 1.6; font-size: 16px; }
        img { max-width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
        a { text-decoration: none; }
        .container { max-width: 1050px; margin: 0 auto; padding: 0 20px; }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { transition: none !important; animation: none !important; } }

        /* ─── Sticky top announcement bar ─── */
        .topbar {
            position: sticky; top: 0; z-index: 200;
            background: var(--green); color: var(--white);
            display: flex; align-items: center; justify-content: center; gap: 20px;
            padding: 10px 20px; flex-wrap: wrap;
            transition: box-shadow 0.3s;
        }
        .topbar.shadow { box-shadow: 0 2px 12px rgba(0,0,0,0.25); }
        .topbar-text { font-size: 12px; letter-spacing: 1.5px; text-transform: uppercase; }
        .topbar-text strong { color: var(--gold); }
        .topbar-book {
            background: var(--gold); color: var(--green);
            padding: 7px 20px; border-radius: 20px;
            font: 700 11px/1 var(--sans); letter-spacing: 1.5px; text-transform: uppercase;
            transition: background 0.25s, transform 0.2s;
            white-space: nowrap;
        }
        .topbar-book:hover { background: var(--white); transform: translateY(-1px); }

        /* ─── Header ─── */
        .site-header { text-align: center; padding: 55px 20px 40px; }
        .avatar-wrap { width: 110px; height: 165px; border-radius: 50%; margin: 0 auto 22px; overflow: hidden; }
        .logo-title { font-family: var(--serif); font-size: 42px; color: var(--green); font-weight: 700; letter-spacing: -1px; line-height: 1; }
        .logo-sub { font-size: 13px; text-transform: uppercase; letter-spacing: 6px; color: var(--green); margin: 10px 0; font-weight: 400; }
        .logo-loc { font-size: 11px; text-transform: uppercase; letter-spacing: 3px; color: var(--muted); }

        /* Social proof strip */
        .proof-strip {
            display: flex; align-items: center; justify-content: center; gap: 28px;
            margin: 22px 0 0; flex-wrap: wrap;
        }
        .proof-item { display: flex; align-items: center; gap: 8px; }
        .proof-stars { color: var(--gold); font-size: 13px; letter-spacing: 1px; }
        .proof-text { font-size: 12px; color: var(--muted); font-weight: 500; letter-spacing: 0.5px; }
        .proof-sep { width: 1px; height: 22px; background: rgba(13,42,24,0.15); }

        /* ─── Section titles ─── */
        .sec-eyebrow { font-size: 13px; text-transform: uppercase; letter-spacing: 4px; color: var(--green); font-weight: 500; }
        .sec-script { font-family: var(--script); font-size: 55px; color: var(--green); margin-top: -12px; line-height: 1.1; }
        .gold-rule { display: block; width: 55px; height: 1px; background: var(--gold); margin: 10px auto 0; }

        /* ─── CTA Buttons ─── */
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--green); color: var(--white);
            padding: 13px 30px; border-radius: 25px;
            font: 600 12px/1 var(--sans); letter-spacing: 1.5px; text-transform: uppercase;
            transition: background 0.25s, transform 0.2s, box-shadow 0.25s;
        }
        .btn-primary:hover { background: #1a4a2e; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13,42,24,0.2); }
        .btn-outline {
            display: inline-flex; align-items: center; gap: 8px;
            border: 1.5px solid var(--green); color: var(--green); background: transparent;
            padding: 11px 28px; border-radius: 25px;
            font: 500 12px/1 var(--sans); letter-spacing: 1.5px; text-transform: uppercase;
            transition: background 0.25s, color 0.25s, transform 0.2s;
        }
        .btn-outline:hover { background: var(--green); color: var(--white); transform: translateY(-1px); }
        .btn-gold {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--gold); color: var(--green);
            padding: 14px 36px; border-radius: 25px;
            font: 700 12px/1 var(--sans); letter-spacing: 2px; text-transform: uppercase;
            transition: background 0.25s, transform 0.2s, box-shadow 0.25s;
        }
        .btn-gold:hover { background: #d4b990; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(197,168,128,0.35); }
        .btn-gold-lg { padding: 17px 50px; font-size: 13px; letter-spacing: 2.5px; }

        /* ─── Artist section ─── */
        .artist-section { display: grid; grid-template-columns: 1fr 1fr; gap: 45px; align-items: center; padding: 30px 0 70px; }
        .artist-img-wrap { width: 100%; height: 460px; border-radius: 4px; overflow: hidden; }
        .artist-text { color: var(--muted); font-size: 15px; text-align: justify; margin-bottom: 22px; font-weight: 300; }
        .artist-sig { font-family: var(--script); font-size: 34px; color: var(--green); line-height: 1; }
        .artist-role { font-size: 11px; text-transform: uppercase; letter-spacing: 2px; color: var(--muted); margin-top: 4px; }
        .artist-cta { margin-top: 28px; display: flex; gap: 12px; flex-wrap: wrap; }

        /* ─── Services cards ─── */
        .services-section { text-align: center; padding: 0 0 70px; }
        .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 28px; }
        .service-card { display: flex; flex-direction: column; align-items: center; gap: 12px; }
        .service-img { width: 100%; height: 260px; border-radius: 18px; overflow: hidden; }
        .service-label { font: 600 12px/1 var(--sans); letter-spacing: 1px; text-transform: uppercase; color: var(--muted); font-size: 11px; background: rgba(197,168,128,0.12); padding: 4px 10px; border-radius: 10px; }
        .service-img img { width: 100%; height: 100%; object-fit: cover; object-position: center; }
        .service-btn {
            display: block; width: 95%; border: 1.5px solid var(--green); padding: 11px 20px; border-radius: 20px;
            font: 500 12px/1 var(--sans); letter-spacing: 1px; text-transform: uppercase; color: var(--green);
            text-align: center; transition: background 0.25s, color 0.25s;
        }
        .service-btn:hover { background: var(--green); color: var(--white); }

        /* ─── Lead Capture ─── */
        .lead-section {
            background: var(--green); color: var(--white);
            padding: 60px 20px; text-align: center;
            margin: 0 calc(-50vw + 50%);
        }
        .lead-eyebrow { font-size: 11px; text-transform: uppercase; letter-spacing: 4px; color: var(--gold); font-weight: 600; margin-bottom: 10px; }
        .lead-title { font-family: var(--serif); font-size: 36px; font-weight: 600; line-height: 1.2; margin-bottom: 8px; }
        .lead-sub { font-size: 14px; color: rgba(255,255,255,0.65); font-weight: 300; margin-bottom: 32px; max-width: 480px; margin-left: auto; margin-right: auto; line-height: 1.7; }
        .lead-form { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; max-width: 680px; margin: 0 auto; }
        .lead-input {
            flex: 1 1 180px; padding: 13px 18px; border-radius: 25px; border: none;
            font: 400 14px var(--sans); background: rgba(255,255,255,0.1);
            color: var(--white); border: 1px solid rgba(255,255,255,0.15);
            transition: border-color 0.2s, background 0.2s; outline: none;
        }
        .lead-input::placeholder { color: rgba(255,255,255,0.45); }
        .lead-input:focus { border-color: var(--gold); background: rgba(255,255,255,0.15); }
        .lead-disclaimer { font-size: 11px; color: rgba(255,255,255,0.35); margin-top: 14px; letter-spacing: 0.5px; }
        .lead-success-msg { font-family: var(--serif); font-size: 22px; color: var(--gold); }
        .lead-success-sub { font-size: 14px; color: rgba(255,255,255,0.65); margin-top: 8px; }

        /* ─── Etiquette ─── */
        .etiquette-section { text-align: center; padding: 0 0 70px; }
        .etiquette-grid { display: grid; grid-template-columns: repeat(5,1fr); gap: 1px; background: rgba(0,0,0,0.08); margin-top: 35px; border-radius: 4px; overflow: hidden; }
        .etiquette-card { background: var(--green); color: var(--white); padding: 32px 14px; }
        .etiquette-num { font-family: var(--serif); font-size: 48px; line-height: 1; margin-bottom: 12px; color: var(--gold); display: block; }
        .etiquette-card h3 { font-size: 11px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px; font-weight: 600; }
        .etiquette-card p { font-size: 13px; line-height: 1.6; color: #e0e6e2; font-weight: 300; }

        /* ─── Menu header ─── */
        .menu-section { padding: 50px 0 30px; border-top: 1px solid rgba(13,42,24,0.08); }
        .cat-title { font-family: var(--serif); font-size: 34px; color: var(--green); text-align: center; margin-bottom: 35px; }
        .cat-title::after { content: ''; display: block; width: 55px; height: 1px; background: var(--gold); margin: 10px auto 0; }

        /* ─── Menu blocks ─── */
        .menu-block { background: var(--white); border: 1px solid rgba(13,42,24,0.05); border-radius: 16px; padding: 38px; margin-bottom: 35px; box-shadow: 0 8px 30px rgba(13,42,24,0.03); }
        .block-title { font-family: var(--serif); font-size: 23px; color: var(--green); margin-bottom: 5px; font-weight: 600; }
        .block-desc { font-size: 14px; color: var(--muted); margin-bottom: 26px; font-weight: 300; }
        .artists-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        .artist-col-title { font-size: 12px; text-transform: uppercase; letter-spacing: 2px; color: var(--green); font-weight: 700; margin-bottom: 16px; border-bottom: 2px solid var(--green); padding-bottom: 4px; display: inline-block; }
        .tier { background: #faf9f6; border-radius: 8px; padding: 16px 18px; margin-bottom: 12px; border: 1px solid rgba(13,42,24,0.02); }
        .tier-top { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 8px; border-bottom: 1px dotted rgba(13,42,24,0.15); padding-bottom: 4px; }
        .tier-label { font-size: 13px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: var(--green); }
        .tier-price { font-size: 16px; font-weight: 700; color: var(--green); }
        .tier-price span { font-weight: 400; font-size: 12px; color: var(--muted); margin-left: 5px; }
        .tier-note { font-size: 13px; color: var(--muted); line-height: 1.5; }
        .tier-note strong { color: var(--green); }
        .tier-gold { color: var(--gold); font-style: italic; font-weight: 500; }
        .alert-banner { background: rgba(197,168,128,0.07); border-left: 3px solid var(--gold); border-radius: 0 8px 8px 0; padding: 12px 18px; margin-top: 22px; font-size: 13px; color: var(--green); }
        .block-cta { margin-top: 22px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; padding-top: 18px; border-top: 1px solid rgba(13,42,24,0.06); }
        .block-cta-text { font-size: 13px; color: var(--muted); }

        /* ─── Extensions grid ─── */
        .ext-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 18px; margin-bottom: 30px; }
        .ext-card { background: var(--white); border: 1px solid rgba(13,42,24,0.05); border-radius: 16px; padding: 28px 22px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 4px 18px rgba(13,42,24,0.03); }
        .ext-title { font-family: var(--serif); font-size: 19px; color: var(--green); margin-bottom: 6px; font-weight: 600; }
        .ext-desc { font-size: 13px; color: var(--muted); margin-bottom: 18px; font-weight: 300; line-height: 1.55; min-height: 52px; }
        .ext-list { border-top: 1px solid rgba(13,42,24,0.06); padding-top: 14px; }
        .ext-row { margin-bottom: 14px; }
        .ext-row-top { display: flex; justify-content: space-between; font-size: 13px; font-weight: 600; color: var(--green); margin-bottom: 3px; }
        .ext-row-top .ecost { color: var(--gold); }
        .ext-time { font-size: 12px; color: var(--muted); margin-bottom: 3px; }
        .ext-rule { background: #faf7f0; border: 1px solid rgba(13,42,24,0.04); padding: 5px 9px; border-radius: 5px; font-size: 11.5px; color: #7a6851; line-height: 1.4; }
        .ext-rule strong { color: var(--green); }

        /* Single row service */
        .single-svc { display: flex; justify-content: space-between; align-items: center; background: var(--white); border: 1px solid rgba(13,42,24,0.05); border-radius: 12px; padding: 20px 28px; margin-bottom: 28px; box-shadow: 0 4px 15px rgba(13,42,24,0.02); gap: 20px; }
        .single-svc-price { font-size: 16px; font-weight: 700; color: var(--green); text-align: right; flex-shrink: 0; white-space: nowrap; }
        .single-svc-price span { display: block; font-size: 12px; font-weight: 400; color: var(--muted); margin-top: 2px; }
        .eligibility-tag { font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #bd3a2b; font-weight: 700; display: block; margin-top: 4px; }

        /* ─── Add-ons section ─── */
        .addons-section { padding: 0 0 50px; }
        .addons-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 0; border: 1px solid rgba(13,42,24,0.08); border-radius: 12px; overflow: hidden; margin-top: 22px; }
        .addon-row { display: flex; justify-content: space-between; align-items: center; padding: 13px 18px; border-bottom: 1px solid rgba(13,42,24,0.06); border-right: 1px solid rgba(13,42,24,0.06); background: var(--white); font-size: 14px; }
        .addon-row:hover { background: #faf8f3; }
        .addon-price { font-weight: 700; color: var(--gold); white-space: nowrap; margin-left: 12px; }

        /* ─── Bundles ─── */
        .bundles-section { padding: 0 0 50px; }
        .bundles-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .bundle-card { background: var(--white); border: 1px solid rgba(13,42,24,0.05); border-radius: 14px; padding: 28px; box-shadow: 0 4px 15px rgba(13,42,24,0.02); }
        .bundle-head { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; border-bottom: 1px solid rgba(13,42,24,0.05); padding-bottom: 10px; }
        .bundle-name { font-family: var(--serif); font-size: 19px; color: var(--green); font-weight: 600; max-width: 65%; }
        .bundle-price { font-size: 18px; font-weight: 700; color: var(--green); text-align: right; }
        .bundle-save { font-size: 11px; color: var(--gold); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-top: 2px; }
        .bundle-policy { font-size: 12px; color: var(--muted); background: #faf8f2; padding: 8px 12px; border-radius: 6px; margin-top: 14px; border-left: 2px solid var(--gold); }

        /* ─── Gift cards ─── */
        .gifts-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-top: 22px; }
        .gift-card { background: var(--white); border: 1px solid rgba(13,42,24,0.05); border-radius: 12px; padding: 24px 18px; text-align: center; box-shadow: 0 4px 14px rgba(13,42,24,0.02); }
        .gift-tier { font-size: 11px; text-transform: uppercase; letter-spacing: 2px; color: var(--muted); font-weight: 600; margin-bottom: 8px; }
        .gift-value { font-family: var(--serif); font-size: 28px; color: var(--green); font-weight: 700; margin-bottom: 14px; }
        .gift-badge { font-size: 11px; text-transform: uppercase; color: var(--gold); letter-spacing: 1px; font-weight: 700; background: #faf8f2; padding: 4px 8px; border-radius: 4px; display: inline-block; }

        /* ─── CTA banner ─── */
        .cta-banner {
            background: linear-gradient(135deg, var(--green) 0%, #1a4a2e 100%);
            border-radius: 18px; padding: 50px 40px; text-align: center;
            margin: 50px 0; color: var(--white);
        }
        .cta-banner-script { font-family: var(--script); font-size: 52px; color: var(--gold); line-height: 1; margin-bottom: 8px; }
        .cta-banner-title { font-family: var(--serif); font-size: 28px; font-weight: 600; margin-bottom: 10px; }
        .cta-banner-sub { font-size: 14px; color: rgba(255,255,255,0.65); margin-bottom: 28px; line-height: 1.7; }
        .cta-urgency { font-size: 11px; text-transform: uppercase; letter-spacing: 2px; color: var(--gold); margin-top: 14px; font-weight: 600; }

        /* ─── FAQ / Footer ─── */
        .footer-bg {
            background: var(--green); color: var(--white);
            padding: 60px 0;
            margin-left: calc(-50vw + 50%);
            margin-right: calc(-50vw + 50%);
        }
        .footer-grid { max-width: 1050px; margin: 0 auto; padding: 0 20px; display: grid; grid-template-columns: 1.2fr 1.8fr; gap: 50px; }
        .footer-left h2 { font-size: 18px; text-transform: uppercase; letter-spacing: 4px; }
        .footer-talks { font-family: var(--script); font-size: 66px; color: var(--gold); line-height: 0.85; margin-bottom: 4px; }
        .footer-faq-badge { font-size: 14px; text-transform: uppercase; letter-spacing: 5px; margin-bottom: 35px; display: block; }
        .faq-item { margin-bottom: 22px; }
        .faq-q { font-size: 14px; font-weight: 600; color: var(--gold); margin-bottom: 6px; text-transform: uppercase; letter-spacing: 1px; }
        .faq-a { font-size: 14px; line-height: 1.65; color: #e0e6e2; font-weight: 300; }

        .spoilers { margin-top: 35px; display: flex; flex-direction: column; gap: 12px; }
        .spoiler { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; overflow: hidden; }
        .spoiler[open] { background: rgba(255,255,255,0.06); border-color: var(--gold); }
        .spoiler summary { padding: 16px 22px; font: 600 13px/1 var(--sans); text-transform: uppercase; letter-spacing: 2px; color: var(--white); cursor: pointer; list-style: none; display: flex; justify-content: space-between; align-items: center; user-select: none; }
        .spoiler summary::-webkit-details-marker { display: none; }
        .spoiler summary::after { content: '+'; font-size: 20px; color: var(--gold); font-weight: 300; }
        .spoiler[open] summary::after { content: '−'; }
        .spoiler-body { padding: 22px; border-top: 1px solid rgba(255,255,255,0.08); color: #e0e6e2; }
        .contact-item { display: flex; align-items: center; gap: 12px; font-size: 14px; color: var(--white); margin-bottom: 14px; }
        .contact-item svg { fill: var(--gold); width: 18px; height: 18px; flex-shrink: 0; }
        .hours-table { font-size: 13px; color: #e0e6e2; width: 100%; }
        .hours-table td { padding: 5px 0; border-bottom: 1px solid rgba(255,255,255,0.04); }
        .hours-table td:last-child { text-align: right; }
        .map-wrap { display: flex; flex-direction: column; align-items: center; gap: 14px; margin-top: 24px; }
        .map-iframe { width: 100%; max-width: 300px; height: 240px; border: 0; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.2); }
        .directions-btn { background: var(--gold); color: var(--green); padding: 11px 26px; border-radius: 22px; font: 700 11px/1 var(--sans); text-transform: uppercase; letter-spacing: 1.5px; transition: background 0.25s, transform 0.2s; }
        .directions-btn:hover { background: var(--white); transform: translateY(-1px); }
        .socials-row { display: flex; justify-content: center; gap: 35px; padding: 26px 20px; }
        .soc-link { display: flex; flex-direction: column; align-items: center; gap: 9px; color: var(--white); font-size: 12px; text-transform: uppercase; letter-spacing: 1px; transition: color 0.25s; }
        .soc-link svg { width: 26px; height: 26px; fill: var(--gold); transition: transform 0.25s, fill 0.25s; }
        .soc-link:hover { color: var(--gold); }
        .soc-link:hover svg { transform: scale(1.15); fill: var(--white); }
        .footer-motto { grid-column: span 2; text-align: right; font-family: var(--script); font-size: 32px; color: var(--gold); margin-top: 35px; padding-top: 18px; border-top: 1px solid rgba(255,255,255,0.08); }

        /* ─── Floating book + scroll-top ─── */
        .fab-book {
            position: fixed; bottom: 28px; right: 28px; z-index: 300;
            background: var(--green); color: var(--white);
            padding: 14px 26px; border-radius: 28px;
            font: 700 12px/1 var(--sans); letter-spacing: 1.5px; text-transform: uppercase;
            box-shadow: 0 6px 24px rgba(0,0,0,0.25);
            display: flex; align-items: center; gap: 10px;
            transition: transform 0.25s, background 0.25s, box-shadow 0.25s;
        }
        .fab-book:hover { background: #1a4a2e; transform: translateY(-3px); box-shadow: 0 10px 32px rgba(0,0,0,0.3); }
        .fab-book svg { width: 16px; height: 16px; fill: var(--gold); }
        .scroll-top-btn {
            position: fixed; bottom: 88px; right: 28px; z-index: 300;
            width: 44px; height: 44px; border-radius: 50%;
            background: var(--gold); display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 14px rgba(0,0,0,0.15);
            opacity: 0; visibility: hidden; transform: translateY(16px);
            transition: opacity 0.35s, visibility 0.35s, transform 0.35s, background 0.25s;
        }
        .scroll-top-btn.visible { opacity: 1; visibility: visible; transform: translateY(0); }
        .scroll-top-btn:hover { background: var(--green); }
        .scroll-top-btn svg { width: 20px; height: 20px; fill: var(--white); }

        /* ─── Responsive ─── */
        @media (max-width: 900px) {
            .ext-grid { grid-template-columns: 1fr; }
            .bundles-grid { grid-template-columns: 1fr; }
            .gifts-grid { grid-template-columns: 1fr 1fr; }
            .fab-book span.fab-label { display: none; }
        }
        @media (max-width: 768px) {
            .artist-section { grid-template-columns: 1fr; }
            .services-grid { grid-template-columns: 1fr; gap: 24px; }
            .etiquette-grid { grid-template-columns: 1fr; }
            .artists-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; }
            .footer-motto { grid-column: span 1; text-align: center; }
            .cta-banner { padding: 36px 22px; }
            .menu-block { padding: 24px; }
        }
        @media (max-width: 600px) {
            .topbar { font-size: 10px; gap: 10px; }
            .logo-title { font-size: 34px; }
            .gifts-grid { grid-template-columns: 1fr 1fr; }
            .proof-strip { gap: 14px; }
            .proof-sep { display: none; }
        }
    </style>
</head>
<body id="top">

<!-- Sticky top bar -->
<div class="topbar" id="topbar">
    <span class="topbar-text"><strong>717-268-9004</strong></span>
    <a href="https://browsreligion.as.me/" target="_blank" rel="noopener" class="topbar-book">Book Online</a>
    <span class="topbar-text">4444 Lankershim Blvd, Suite 207 · Toluca Lake, CA 91602</span>
</div>

<div class="container">

    <!-- Header -->
    <header class="site-header">
        <div class="avatar-wrap">
            <img src="/image/face-coloure.png" alt="BrowsReligion">
        </div>
        <h1 class="logo-title">browsreligion</h1>
        <p class="logo-sub">brows · lashes · pmu</p>
        <p class="logo-loc">Los Angeles, California</p>
        <div class="proof-strip">
            <div class="proof-item">
                <span class="proof-stars">★★★★★</span>
                <span class="proof-text">5.0 on Google</span>
            </div>
            <div class="proof-sep"></div>
            <div class="proof-item">
                <span class="proof-text">3,200+ happy clients</span>
            </div>
            <div class="proof-sep"></div>
            <div class="proof-item">
                <span class="proof-text">7 years of craft</span>
            </div>
        </div>
    </header>

    <!-- Artist -->
    <section class="artist-section">
        <div>
            <p class="sec-eyebrow">Meet Your</p>
            <div class="sec-script">Artist</div>
            <p class="artist-text">Brows and lashes are more than just beauty — they're a confidence boost, and I'm obsessed with helping you look and feel your best. Whether it's shaping the perfect arch, giving your lashes that dreamy lift, or creating a custom look just for you — I'm all about those little details that make a big difference.</p>
            <p class="artist-text">Beauty should be fun, effortless, and uniquely you. Whether you're here for a bold transformation or a natural touch-up, I'm here to make the process easy, relaxing, and tailored to your style.</p>
            <div class="artist-sig">Alena K.</div>
            <p class="artist-role">Master Artist</p>
            <div class="artist-cta">
                <a href="https://browsreligion.as.me/" target="_blank" rel="noopener" class="btn-primary">Book with Alena →</a>
                <a href="#menu" class="btn-outline">View Pricing</a>
            </div>
        </div>
        <div class="artist-img-wrap">
            <img src="/image/face.png" alt="Alena — Master Artist">
        </div>
    </section>

    <!-- Services visual -->
    <section class="services-section">
        <p class="sec-eyebrow">Signature</p>
        <div class="sec-script" style="font-size:46px">Services</div>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-img"><img src="/image/BrowLamination.png" alt="Brow Lamination"></div>
                <span class="service-label">From $100</span>
                <a href="#brow-lam" class="service-btn">Brow Lamination</a>
            </div>
            <div class="service-card">
                <div class="service-img"><img src="/image/LashExtencion.png" alt="Lash Extensions"></div>
                <span class="service-label">From $100</span>
                <a href="#lash-svc" class="service-btn">Lash Services</a>
            </div>
            <div class="service-card">
                <div class="service-img"><img src="/image/SignatureBrowSculpt.png" alt="Brow Sculpt"></div>
                <span class="service-label">From $45</span>
                <a href="#brow-shape" class="service-btn">Signature Brow Shape</a>
            </div>
        </div>
    </section>

</div><!-- /container -->

<!-- Lead Capture -->
<div class="lead-section">
    <div class="container" style="max-width:720px">
        <?php if ($lead_success): ?>
            <p class="lead-success-msg">You're on the list ✦</p>
            <p class="lead-success-sub">We'll be in touch soon with your exclusive offer. Can't wait? Book directly below.</p>
            <br>
            <a href="https://browsreligion.as.me/" target="_blank" rel="noopener" class="btn-gold" style="margin-top:8px">Book Now →</a>
        <?php else: ?>
            <p class="lead-eyebrow">New client offer</p>
            <h2 class="lead-title">First visit? Get priority booking + exclusive first-timer offer.</h2>
            <p class="lead-sub">Leave your details and we'll personally reach out to get you scheduled. No spam — just your appointment.</p>
            <form class="lead-form" method="post" action="#lead">
                <input type="text"  name="lead_name"  class="lead-input" placeholder="Your name *" required autocomplete="name">
                <input type="email" name="lead_email" class="lead-input" placeholder="Email address *" required autocomplete="email">
                <input type="tel"   name="lead_phone" class="lead-input" placeholder="Phone (optional)" autocomplete="tel">
                <button type="submit" class="btn-gold" style="flex:0 0 auto;border:none;cursor:pointer">Claim Offer →</button>
            </form>
            <p class="lead-disclaimer">Your information is never shared. We'll contact you within 24 hours.</p>
        <?php endif; ?>
    </div>
</div>

<div class="container">

    <!-- ══ PRICING MENU ══ -->
    <section class="menu-section" id="menu">
        <p class="sec-eyebrow" style="text-align:center">Our Full</p>
        <div class="sec-script" style="font-size:50px;text-align:center;margin-top:-12px">Menu & Pricing</div>

        <!-- 1. BROW SERVICES -->
        <h2 class="cat-title" style="margin-top:45px">1. Brow Services</h2>

        <div class="menu-block" id="brow-lam">
            <h3 class="block-title">Brow Lamination</h3>
            <p class="block-desc">Transform your brows into their dream shape — lifted, fluffy, and perfectly styled for up to 8 weeks!</p>
            <div class="artists-grid">
                <div>
                    <div class="artist-col-title">With Alena</div>
                    <div class="tier">
                        <div class="tier-top"><span class="tier-label">New Client</span><div class="tier-price">$150.00<span>/ 1 hr</span></div></div>
                        <p class="tier-note"><strong>Includes:</strong> Extended session to understand your natural brow pattern, precise shaping (wax or tweeze, no threading), and aftercare kit. Optional tint or hybrid stain add-on available.</p>
                    </div>
                    <div class="tier">
                        <div class="tier-top"><span class="tier-label">Returning Client</span><div class="tier-price">$120.00<span>/ 45 min</span></div></div>
                    </div>
                </div>
                <div>
                    <div class="artist-col-title">With Tanya</div>
                    <div class="tier">
                        <div class="tier-top"><span class="tier-label">New Client</span><div class="tier-price">$120.00<span>/ 1 hr</span></div></div>
                        <p class="tier-note"><strong>Includes:</strong> Lift, set, and tame your brows for a fuller, fluffy, effortlessly styled look. Extended appointment, customized exactly how you like them. Shaping (wax or tweeze), aftercare. Optional tint or hybrid stain add-on.</p>
                    </div>
                    <div class="tier">
                        <div class="tier-top"><span class="tier-label">Returning Client</span><div class="tier-price">$100.00<span>/ 45 min</span></div></div>
                        <p class="tier-note"><span class="tier-gold">Already done your eyebrows :)</span></p>
                    </div>
                </div>
            </div>
            <div class="alert-banner">⚠️ <strong>Contraindications:</strong> Not recommended if pregnant, breastfeeding, using Retin-A/Retinol, or with eczema/psoriasis near brows.</div>
            <div class="block-cta">
                <span class="block-cta-text">Online payment required to secure booking.</span>
                <a href="https://browsreligion.as.me/" target="_blank" rel="noopener" class="btn-primary">Book Brow Lamination →</a>
            </div>
        </div>

        <div class="menu-block" id="brow-shape">
            <h3 class="block-title">Signature Brow Shape</h3>
            <p class="block-desc">Bespoke grooming shaped flawlessly to coordinate with your natural features.</p>
            <div class="artists-grid">
                <div>
                    <div class="artist-col-title">With Alena</div>
                    <div class="tier">
                        <div class="tier-top"><span class="tier-label">New Client</span><div class="tier-price">$80.00<span>/ 45 min</span></div></div>
                        <p class="tier-note"><strong>Includes:</strong> Extended consultation, customized shape for your face, wax or tweeze (no threading), aftercare guidance. Optional tint/stain and Brow Styling &amp; Highlight.</p>
                    </div>
                    <div class="tier">
                        <div class="tier-top"><span class="tier-label">Returning Client</span><div class="tier-price">$60.00<span>/ 30 min</span></div></div>
                        <p class="tier-note"><span class="tier-gold">Seen you for eyebrows before :)</span></p>
                    </div>
                </div>
                <div>
                    <div class="artist-col-title">With Tanya</div>
                    <div class="tier">
                        <div class="tier-top"><span class="tier-label">New Client</span><div class="tier-price">$60.00<span>/ 45 min</span></div></div>
                        <p class="tier-note"><strong>Includes:</strong> Extended consultation, customized shape, wax or tweeze (no threading), aftercare. Optional tint/stain and Brow Styling &amp; Highlight.</p>
                    </div>
                    <div class="tier">
                        <div class="tier-top"><span class="tier-label">Returning Client</span><div class="tier-price">$45.00<span>/ 30 min</span></div></div>
                        <p class="tier-note"><span class="tier-gold">Seen you for eyebrows before :)</span></p>
                    </div>
                </div>
            </div>
            <div class="alert-banner">⚠️ <strong>Important:</strong> Please avoid Retin-A products 72 hours prior to your appointment.</div>
            <div class="block-cta">
                <span class="block-cta-text">Online payment required to secure booking.</span>
                <a href="https://browsreligion.as.me/" target="_blank" rel="noopener" class="btn-primary">Book Brow Shape →</a>
            </div>
        </div>

        <div class="single-svc" style="margin-bottom:55px">
            <div>
                <h3 class="block-title" style="font-size:19px">Brow Lamination Maintenance</h3>
                <span class="eligibility-tag">Existing Clients Only</span>
                <p class="tier-note" style="margin-top:6px">For clients 3–4 weeks post-lamination. Includes: Brow Exfoliation, deep conditioning treatment, Clean Up (wax/tweeze), fresh Tint or Hybrid Stain.</p>
            </div>
            <div class="single-svc-price">$80.00<span>1 hour</span></div>
        </div>

        <!-- 2. LASH SERVICES -->
        <h2 class="cat-title" id="lash-svc">2. Lash Services</h2>

        <div class="menu-block">
            <h3 class="block-title">Lash Lift</h3>
            <p class="block-desc">A 3-step treatment to lift and curl your natural lashes for an eye-popping look lasting 4–8 weeks. Tint can be added for a mascara-free dark finish — perfect "woke up like this" appearance.</p>
            <div class="artists-grid" style="margin-bottom:12px">
                <div class="tier" style="margin-bottom:0">
                    <div class="tier-top"><span class="tier-label" style="font-weight:700">With Alena</span><div class="tier-price">$130.00<span>/ 1 hr</span></div></div>
                </div>
                <div class="tier" style="margin-bottom:0">
                    <div class="tier-top"><span class="tier-label" style="font-weight:700">With Tanya</span><div class="tier-price">$100.00<span>/ 1 hr</span></div></div>
                </div>
            </div>
            <div class="alert-banner">⚠️ <strong>Contraindications:</strong> NOT recommended if pregnant or breastfeeding.</div>
            <div class="block-cta">
                <span class="block-cta-text">Online payment required to secure booking.</span>
                <a href="https://browsreligion.as.me/" target="_blank" rel="noopener" class="btn-primary">Book Lash Lift →</a>
            </div>
        </div>

        <div class="ext-grid">
            <div class="ext-card">
                <div>
                    <h4 class="ext-title">Classic Extensions</h4>
                    <p class="ext-desc">Soft &amp; natural look — enhances original volume. Single extension per natural lash. Perfect "mascara effect."</p>
                </div>
                <div class="ext-list">
                    <div class="ext-row"><div class="ext-row-top"><span>Classic Full Set</span><span class="ecost">$160.00</span></div><div class="ext-time">2 hours</div><div class="ext-rule">Fills every 2–3 weeks. Foreign fills require <strong>removal</strong>.</div></div>
                    <div class="ext-row"><div class="ext-row-top"><span>Fill — 2 Weeks</span><span class="ecost">$80.00</span></div><div class="ext-time">1 hr 30 min</div><div class="ext-rule">Min. <strong>60%</strong> lashes remaining. Arrive clean.</div></div>
                    <div class="ext-row" style="margin-bottom:0"><div class="ext-row-top"><span>Fill — 3 Weeks</span><span class="ecost">$100.00</span></div><div class="ext-time">1 hr 30 min</div><div class="ext-rule">Min. <strong>40–50%</strong> remaining. Past 3 wks = new set.</div></div>
                </div>
            </div>
            <div class="ext-card">
                <div>
                    <h4 class="ext-title">Hybrid Extensions</h4>
                    <p class="ext-desc">Balance of classic &amp; volume. Everyday enhancement or glamorous — suits various occasions.</p>
                </div>
                <div class="ext-list">
                    <div class="ext-row"><div class="ext-row-top"><span>Hybrid Full Set</span><span class="ecost">$180.00</span></div><div class="ext-time">2 hours</div><div class="ext-rule">Fills every 2–3 weeks. Foreign fills require <strong>removal</strong>.</div></div>
                    <div class="ext-row"><div class="ext-row-top"><span>Fill — 2 Weeks</span><span class="ecost">$90.00</span></div><div class="ext-time">1 hour</div><div class="ext-rule">Min. <strong>60%</strong> lashes remaining. Arrive clean.</div></div>
                    <div class="ext-row" style="margin-bottom:0"><div class="ext-row-top"><span>Fill — 3 Weeks</span><span class="ecost">$110.00</span></div><div class="ext-time">1 hr 30 min</div><div class="ext-rule">Min. <strong>40–50%</strong> remaining. Past 3 wks = new set.</div></div>
                </div>
            </div>
            <div class="ext-card">
                <div>
                    <h4 class="ext-title">Volume Extensions</h4>
                    <p class="ext-desc">Bold &amp; dramatic. Fluffy, glamorous runway look for maximum impact.</p>
                </div>
                <div class="ext-list">
                    <div class="ext-row"><div class="ext-row-top"><span>Volume Full Set</span><span class="ecost">$200.00</span></div><div class="ext-time">2 hr 30 min</div><div class="ext-rule">Fills every 2–3 weeks. Foreign fills require <strong>removal</strong>.</div></div>
                    <div class="ext-row"><div class="ext-row-top"><span>Fill — 2 Weeks</span><span class="ecost">$100.00</span></div><div class="ext-time">1 hr 30 min</div><div class="ext-rule">Min. <strong>60%</strong> lashes remaining. Arrive clean.</div></div>
                    <div class="ext-row" style="margin-bottom:0"><div class="ext-row-top"><span>Fill — 3 Weeks</span><span class="ecost">$120.00</span></div><div class="ext-time">1 hr 40 min</div><div class="ext-rule">Min. <strong>40–50%</strong> remaining. Past 3 wks = new set.</div></div>
                </div>
            </div>
        </div>

        <div class="single-svc" style="margin-bottom:30px">
            <div>
                <h3 class="block-title" style="font-size:19px">Lash Extensions Removal</h3>
                <p class="tier-note" style="margin-top:6px">Remover cream for an easy, safe, and comfortable removal — protects your natural lashes.</p>
            </div>
            <div class="single-svc-price">$30.00<span>30 min</span></div>
        </div>
        <div style="text-align:center; margin-bottom:55px">
            <a href="https://browsreligion.as.me/" target="_blank" rel="noopener" class="btn-primary">Book Lash Services →</a>
        </div>

        <!-- 3. SPECIAL SERVICES -->
        <h2 class="cat-title">3. Special Services</h2>
        <div style="display:grid; grid-template-columns:1.6fr 1.4fr; gap:22px; margin-bottom:55px">
            <div class="menu-block" style="margin-bottom:0">
                <h4 class="block-title">House Call</h4>
                <span style="font-size:14px;font-weight:700;color:var(--gold);text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:18px">Starts at $700.00 / 5 hours</span>
                <p class="tier-note">Price varies by location and number of services. <strong>$100 deposit</strong> required on booking. In the notes, include your location, number of people, and services needed. You'll be contacted to confirm your invoice total.<br><br>Questions? <a href="mailto:info@browsreligion.com" style="color:var(--gold)">info@browsreligion.com</a></p>
            </div>
            <div class="menu-block" style="margin-bottom:0">
                <h4 class="block-title">Patch Test</h4>
                <span style="font-size:14px;font-weight:700;color:var(--gold);text-transform:uppercase;letter-spacing:0.5px;display:block;margin-bottom:18px">Free · 15 min · Highly Recommended</span>
                <p class="tier-note">Recommended for sensitive skin or anyone who has experienced reactions to skincare products. Avoids a reaction that takes days or weeks to clear. Better a small test patch than a full-face reaction.</p>
            </div>
        </div>

        <!-- 4. ADD-ONS -->
        <h2 class="cat-title">4. Add-Ons</h2>
        <p style="text-align:center;color:var(--muted);font-size:14px;margin:-20px 0 8px">Can be added to most services during booking.</p>
        <section class="addons-section">
            <div class="addons-grid">
                <div class="addon-row"><span>Brow Tint</span><span class="addon-price">$20</span></div>
                <div class="addon-row"><span>Hybrid Stain</span><span class="addon-price">$30</span></div>
                <div class="addon-row"><span>Lash Tint</span><span class="addon-price">$30</span></div>
                <div class="addon-row"><span>Lash Lift</span><span class="addon-price">$130</span></div>
                <div class="addon-row"><span>Hydro-Jelly Brow Mask</span><span class="addon-price">$15</span></div>
                <div class="addon-row"><span>BOTOX Deep Conditioning</span><span class="addon-price">$25</span></div>
                <div class="addon-row"><span>Upper Lip Wax</span><span class="addon-price">$15</span></div>
                <div class="addon-row"><span>Nose Wax</span><span class="addon-price">$20</span></div>
                <div class="addon-row"><span>Ear Wax</span><span class="addon-price">$20</span></div>
                <div class="addon-row"><span>Silent Appointment</span><span class="addon-price" style="color:#6abf8a">Free</span></div>
            </div>
        </section>

        <!-- 5. BUNDLES -->
        <h2 class="cat-title">5. Bundle Deals</h2>
        <p style="text-align:center;color:var(--muted);font-size:14px;max-width:620px;margin:-20px auto 30px;line-height:1.7">Buy 5 sessions for the price of 4. A personal code is emailed to you upon purchase — redeem immediately or over time. Codes never expire. Single-person use only.</p>
        <section class="bundles-section">
            <div class="bundles-grid">
                <div class="bundle-card"><div class="bundle-head"><div class="bundle-name">Signature Brow Sculpt Bundle</div><div class="bundle-price">$240.00<span class="bundle-save">Save $60</span></div></div><div class="bundle-policy"><strong>Does not expire.</strong> Single-person use; cannot be transferred.</div></div>
                <div class="bundle-card"><div class="bundle-head"><div class="bundle-name">Brow Lamination Bundle</div><div class="bundle-price">$480.00<span class="bundle-save">Save $120</span></div></div><div class="bundle-policy"><strong>Does not expire.</strong></div></div>
                <div class="bundle-card"><div class="bundle-head"><div class="bundle-name">Brow Lam × Hybrid Stain Bundle</div><div class="bundle-price">$600.00<span class="bundle-save">Save $150</span></div></div><div class="bundle-policy"><strong>Does not expire.</strong></div></div>
                <div class="bundle-card"><div class="bundle-head"><div class="bundle-name">Lash Lift Bundle</div><div class="bundle-price">$520.00<span class="bundle-save">Save $130</span></div></div><div class="bundle-policy"><strong>Does not expire.</strong></div></div>
            </div>
        </section>

        <!-- 6. GIFT CARDS -->
        <h2 class="cat-title">6. Gift Cards</h2>
        <p style="text-align:center;color:var(--muted);font-size:14px;max-width:550px;margin:-20px auto 8px;line-height:1.7">Send a digital gift card to your loved ones. Code emailed upon purchase. Redeem immediately or over time. Never expires.</p>
        <div class="gifts-grid" style="margin-bottom:60px">
            <div class="gift-card"><div class="gift-tier">Bronze</div><div class="gift-value">$50</div><span class="gift-badge">No Expiration</span></div>
            <div class="gift-card"><div class="gift-tier">Silver</div><div class="gift-value">$100</div><span class="gift-badge">No Expiration</span></div>
            <div class="gift-card"><div class="gift-tier">Gold</div><div class="gift-value">$250</div><span class="gift-badge">No Expiration</span></div>
            <div class="gift-card"><div class="gift-tier">Platinum</div><div class="gift-value">$500</div><span class="gift-badge">No Expiration</span></div>
        </div>

    </section>

    <!-- Etiquette -->
    <section class="etiquette-section" style="padding-top:60px">
        <p class="sec-eyebrow">Appointment</p>
        <div class="sec-script" style="font-size:50px;margin-top:-10px">etiquette.</div>
        <div class="etiquette-grid">
            <div class="etiquette-card">
                <span class="etiquette-num">1</span>
                <h3>Save the Date</h3>
                <p>Book ahead to secure your slot. A deposit is required for select services and goes toward your total.</p>
            </div>
            <div class="etiquette-card">
                <span class="etiquette-num">2</span>
                <h3>Cancellations</h3>
                <p>48-hour notice required to reschedule or cancel. Failure to do so results in a 50% cancellation fee.</p>
            </div>
            <div class="etiquette-card">
                <span class="etiquette-num">3</span>
                <h3>Running Late?</h3>
                <p>We offer a 10-minute grace period. More than 15 minutes late may require a reschedule.</p>
            </div>
            <div class="etiquette-card">
                <span class="etiquette-num">4</span>
                <h3>No Shows</h3>
                <p>Missed appointments without notice result in a 100% service charge to cover lost slot time.</p>
            </div>
            <div class="etiquette-card">
                <span class="etiquette-num">5</span>
                <h3>Wellness First</h3>
                <p>We understand life happens. Please stay home if you are sick — be thoughtful when booking.</p>
            </div>
        </div>
    </section>

    <!-- CTA Banner -->
    <div class="cta-banner">
        <div class="cta-banner-script">Ready?</div>
        <h2 class="cta-banner-title">Your brows deserve the best.</h2>
        <p class="cta-banner-sub">Limited appointment slots available each week with Alena and Tanya.<br>Online payment secures your spot.</p>
        <a href="https://browsreligion.as.me/" target="_blank" rel="noopener" class="btn-gold btn-gold-lg">Book Your Appointment →</a>
        <p class="cta-urgency">✦ Spots fill fast — book early to secure your preferred time ✦</p>
    </div>

</div><!-- /container -->

<!-- FAQ / Footer -->
<div class="footer-bg" id="contact">
    <div class="footer-grid">
        <div class="footer-left">
            <h2>browsreligion</h2>
            <div class="footer-talks">talks.</div>
            <span class="footer-faq-badge">FAQ</span>
            <div style="overflow:hidden;border-radius:4px;margin-bottom:12px;height:120px"><img src="/image/bottomIMG1.png" alt="" style="object-fit:cover;width:100%;height:100%"></div>
            <div style="overflow:hidden;border-radius:4px;height:160px"><img src="/image/bottomIMG2.png" alt="" style="object-fit:cover;width:100%;height:100%"></div>
        </div>
        <div class="footer-right">
            <div class="faq-item"><p class="faq-q">What services do you offer?</p><p class="faq-a">From premium brow shaping and lamination to luxury custom lash extensions — we design everything to frame your natural beauty perfectly.</p></div>
            <div class="faq-item"><p class="faq-q">How long does a typical appointment take?</p><p class="faq-a">A Signature Brow Shape takes 30–45 min, Lamination takes up to 1 hr, and a Volume Full Set can take up to 2.5 hours of precision work.</p></div>
            <div class="faq-item"><p class="faq-q">Can you help me choose a style?</p><p class="faq-a">Absolutely! We examine your bone structure, hair growth pattern, and personal styling goals during extended consultations to map a completely bespoke look.</p></div>
            <div class="faq-item"><p class="faq-q">What is your lash refill policy?</p><p class="faq-a">Fills every 2–3 weeks. 60% remaining for a 2-week fill; 40–50% for 3-week. Beyond 3 weeks requires a fresh Full Set.</p></div>

            <div class="spoilers">
                <details class="spoiler">
                    <summary>Contacts & Hours</summary>
                    <div class="spoiler-body">
                        <div style="display:grid;grid-template-columns:1.1fr 0.9fr;gap:20px">
                            <div>
                                <div class="contact-item"><svg viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg><span>717-268-9004</span></div>
                                <div class="contact-item"><svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg><span>info@browsreligion.com</span></div>
                                <div class="contact-item"><svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg><div>4444 Lankershim Blvd<br>Toluca Lake, CA 91602<br>Suite 207 (Second Floor)</div></div>
                                <a href="https://maps.google.com/?q=4444+Lankershim+Blvd+Toluca+Lake+CA+91602" target="_blank" rel="noopener" class="directions-btn" style="margin-top:14px;display:inline-flex;align-items:center;gap:8px">Get Directions</a>
                            </div>
                            <div>
                                <table class="hours-table">
                                    <tr><td>MON</td><td>Closed</td></tr>
                                    <tr><td>TUE</td><td>9:00–7:00</td></tr>
                                    <tr><td>WED</td><td>9:00–7:00</td></tr>
                                    <tr><td>THU</td><td>9:00–7:00</td></tr>
                                    <tr><td>FRI</td><td>9:00–7:00</td></tr>
                                    <tr><td>SAT</td><td>10:00–6:00</td></tr>
                                    <tr><td>SUN</td><td>Closed</td></tr>
                                </table>
                            </div>
                        </div>
                        <div class="map-wrap">
                            <iframe class="map-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d317.87233787154764!2d-118.3667091330127!3d34.15176373103451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bf5c99971e8b%3A0xbf817ccfb81d309a!2sBrowsReligion%20%7C%20Brows%20%26%20Lash%20Services!5e1!3m2!1suk!2sat!4v1779524545761!5m2!1suk!2sat" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </details>
                <details class="spoiler">
                    <summary>Social Media</summary>
                    <div class="spoiler-body">
                        <div class="socials-row">
                            <a href="https://www.instagram.com/browsreligion" target="_blank" rel="noopener" class="soc-link"><svg viewBox="0 0 24 24"><path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8A3.6 3.6 0 0 0 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6A3.6 3.6 0 0 0 16.4 4H7.6m9.65 1.5a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3z"/></svg><span>Instagram</span></a>
                            <a href="#" class="soc-link"><svg viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.8c4.56-.93 8-4.96 8-9.8z"/></svg><span>Facebook</span></a>
                            <a href="#" class="soc-link"><svg viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.77 0 2.89 2.89 0 0 1 2.89-2.89h.56V9.44h-.56a6.33 6.33 0 1 0 6.33 6.33V8.81a8.45 8.45 0 0 0 4.13 1.09V6.69z"/></svg><span>TikTok</span></a>
                        </div>
                    </div>
                </details>
            </div>
        </div>
        <div class="footer-motto">where we treat your face just like ours</div>
    </div>
</div>

<!-- FAB Book Now -->
<a href="https://browsreligion.as.me/" target="_blank" rel="noopener" class="fab-book" aria-label="Book appointment">
    <svg viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/></svg>
    <span class="fab-label">Book Now</span>
</a>
<a href="#top" id="scrollTop" class="scroll-top-btn" aria-label="Back to top">
    <svg viewBox="0 0 24 24"><path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.58 5.59L20 12l-8-8-8 8z"/></svg>
</a>

<script>
    // Scroll-to-top visibility
    const scrollBtn = document.getElementById('scrollTop');
    const topbar = document.getElementById('topbar');
    window.addEventListener('scroll', () => {
        scrollBtn.classList.toggle('visible', window.scrollY > 350);
        topbar.classList.toggle('shadow', window.scrollY > 10);
    }, { passive: true });

    // Smooth anchor scroll
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const id = a.getAttribute('href').slice(1);
            const el = id ? document.getElementById(id) : null;
            if (el) { e.preventDefault(); el.scrollIntoView({ behavior: 'smooth' }); }
        });
    });
</script>
</body>
</html>
