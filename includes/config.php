<?php
require_once __DIR__ . '/../vendor/autoload.php';

$smarty = new \Smarty\Smarty();
$smarty->setTemplateDir(__DIR__ . '/../templates/');
$smarty->setCompileDir(__DIR__ . '/../compile/');
$smarty->setCacheDir(__DIR__ . '/../cache/');
$smarty->caching = false;

$services = [
    ['name' => 'Brow Shaping & Wax', 'price' => '$35', 'duration' => '30 min',
     'desc' => 'Precision sculpting to define your perfect arch. Wax & tweeze finish.',
     'icon' => '✦'],
    ['name' => 'Brow Tinting', 'price' => '$25', 'duration' => '20 min',
     'desc' => 'Deposit rich colour that fills gaps and enhances natural density.',
     'icon' => '◈'],
    ['name' => 'Brow Lamination', 'price' => '$75', 'duration' => '60 min',
     'desc' => 'Lift, restructure and set brow hairs into your ideal shape for 6–8 weeks.',
     'icon' => '◉'],
    ['name' => 'Microblading', 'price' => '$350', 'duration' => '2 hrs',
     'desc' => 'Hairlike semi-permanent strokes for a naturally full, defined brow. Lasts 12–18 months.',
     'icon' => '⟡'],
    ['name' => 'Ombre Powder Brows', 'price' => '$380', 'duration' => '2.5 hrs',
     'desc' => 'A soft, powdery finish from light to dark. Perfect for makeup-lovers.',
     'icon' => '◇'],
    ['name' => 'Combination Brows', 'price' => '$420', 'duration' => '3 hrs',
     'desc' => 'Microblading strokes in the front + powder shading toward the tail. Best of both worlds.',
     'icon' => '✧'],
];

$testimonials = [
    ['name' => 'Olivia M.', 'text' => 'I\'ve had microblading done twice before at other studios — BrowsReligion is in a completely different league. The artistry, the care, the result. My brows changed my face.',
     'service' => 'Microblading', 'rating' => 5],
    ['name' => 'Sophia R.', 'text' => 'Brow lamination here lasts twice as long as anywhere I\'ve tried. And the shape is always exactly what I wanted — even when I couldn\'t describe it myself.',
     'service' => 'Brow Lamination', 'rating' => 5],
    ['name' => 'Natalie K.', 'text' => 'Came in anxious. Left obsessed. The consultation alone was worth the trip — she explained everything, matched my face shape, and the result was stunning.',
     'service' => 'Ombre Powder Brows', 'rating' => 5],
];

$faqs = [
    ['q' => 'How do I prepare for my appointment?',
     'a' => 'Avoid caffeine on the day of semi-permanent treatments. Do not tint, wax, or thread brows 48 hours prior. Arrive with a clean, makeup-free brow area.'],
    ['q' => 'How long does microblading last?',
     'a' => 'Results typically last 12–18 months depending on skin type, lifestyle and aftercare. A touch-up at 6–8 weeks is included in the initial service price.'],
    ['q' => 'Is there downtime after powder brows?',
     'a' => 'Expect 7–10 days of gentle peeling. Brows will appear darker initially, then soften to the finished tone. Avoid water, sweat, and makeup on the brow area during healing.'],
    ['q' => 'Can I book same-day?',
     'a' => 'Same-day slots are rare but sometimes available. We recommend booking at least 3–5 days ahead for waxing/tinting, and 2+ weeks for semi-permanent services.'],
    ['q' => 'What is your cancellation policy?',
     'a' => '48 hours notice is required for semi-permanent services; 24 hours for all other bookings. Late cancellations may incur a 50% service fee.'],
];

$stats = [
    ['value' => '3,200+', 'label' => 'Clients Served'],
    ['value' => '98%',    'label' => 'Satisfaction Rate'],
    ['value' => '7 yrs',  'label' => 'Studio Experience'],
    ['value' => '6',      'label' => 'Signature Services'],
];
