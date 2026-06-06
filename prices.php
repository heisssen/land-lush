<?php
require_once __DIR__ . '/vendor/autoload.php';

$smarty = new \Smarty\Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates/');
$smarty->setCompileDir(__DIR__ . '/compile/');
$smarty->setCacheDir(__DIR__ . '/cache/');
$smarty->caching = false;

$smarty->display('prices.tpl');
