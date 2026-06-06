<?php
require_once __DIR__ . '/includes/config.php';

$errors = [];
$field_errors = [];
$form = [];
$success = false;
$preselect = isset($_GET['service']) ? htmlspecialchars($_GET['service']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = array_map('trim', $_POST);

    if (empty($form['first_name'])) { $errors[] = 'First name is required.'; $field_errors['first_name'] = true; }
    if (empty($form['last_name']))  { $errors[] = 'Last name is required.';  $field_errors['last_name']  = true; }
    if (empty($form['email']) || !filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email address is required.'; $field_errors['email'] = true;
    }
    if (empty($form['service']))   { $errors[] = 'Please select a service.';      $field_errors['service']   = true; }
    if (empty($form['pref_date'])) { $errors[] = 'Preferred date is required.';   $field_errors['pref_date'] = true; }
    if (empty($form['pref_time'])) { $errors[] = 'Preferred time is required.';   $field_errors['pref_time'] = true; }
    if (empty($form['consent']))   { $errors[] = 'Please accept the cancellation policy.'; }

    if (empty($errors)) {
        $booking = [
            'id'         => uniqid('BR', true),
            'created_at' => date('Y-m-d H:i:s'),
            'first_name' => $form['first_name'],
            'last_name'  => $form['last_name'],
            'email'      => $form['email'],
            'phone'      => $form['phone'] ?? '',
            'service'    => $form['service'],
            'pref_date'  => $form['pref_date'],
            'pref_time'  => $form['pref_time'],
            'notes'      => $form['notes'] ?? '',
            'status'     => 'pending',
        ];

        $data_file = __DIR__ . '/data/bookings.json';
        $bookings  = file_exists($data_file) ? json_decode(file_get_contents($data_file), true) : [];
        $bookings[] = $booking;
        file_put_contents($data_file, json_encode($bookings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $success = true;
        $form = [];
    }
}

$smarty->assign('services',     $services);
$smarty->assign('errors',       $errors);
$smarty->assign('field_errors', $field_errors);
$smarty->assign('form',         $form);
$smarty->assign('success',      $success);
$smarty->assign('preselect',    $preselect);

$smarty->display('booking.tpl');
