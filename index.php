<?php
require_once __DIR__ . '/includes/config.php';

$smarty->assign('services',     $services);
$smarty->assign('testimonials', $testimonials);
$smarty->assign('faqs',         $faqs);
$smarty->assign('stats',        $stats);

$smarty->assign('has_about_img', file_exists(__DIR__ . '/images/about.jpg'));

$smarty->display('home.tpl');
