<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login', 'Auth::processLogin');
$routes->post('processLogin', 'Auth::processLogin');
$routes->get('logout', 'Auth::logout');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register', 'Auth::processRegister');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::processRegister');

$routes->group('chat', ['filter' => 'auth'], static function ($routes) {
    $routes->post('send', 'Chat::send');
    $routes->get('updates', 'Chat::get_updates');
});

$routes->group('patient', ['filter' => ['auth', 'role:patient']], static function ($routes) {
    $routes->get('/', 'Patient::index');
    $routes->get('consultation', 'Patient::consultation');
    $routes->get('prescription', 'Patient::prescription');
    $routes->get('history', 'Patient::history');
    $routes->get('historyDetail', 'Patient::historyDetail');
    $routes->get('profile', 'Patient::profile');
    $routes->get('edit_profile', 'Patient::editProfile');
    $routes->post('profile/update', 'Patient::updateProfile');
    $routes->post('family/add', 'Patient::addFamilyMember');
    $routes->get('family/delete/(:num)', 'Patient::deleteFamilyMember/$1');
    $routes->get('chat', 'Patient::chat');
    $routes->get('wellness', 'Patient::wellness');
    $routes->post('book_appointment', 'Patient::bookAppointment');
    $routes->post('cancel_appointment', 'Patient::cancelAppointment');
    $routes->post('reschedule_appointment', 'Patient::rescheduleAppointment');
    $routes->get('payment', 'Patient::payment');
    $routes->post('process_payment', 'Patient::processPayment');
    $routes->post('checkout_prescription', 'Patient::checkoutPrescription');
    $routes->get('payments', 'Patient::payments');
    $routes->get('invoice', 'Patient::invoice');
    $routes->get('notifications', 'Patient::notifications');
    $routes->post('notifications/read-all', 'Patient::readAllNotifications');
});

$routes->group('doctor', ['filter' => ['auth', 'role:doctor']], static function ($routes) {
    $routes->get('/', 'Doctor::index');
    $routes->get('consultation', 'Doctor::consultation');
    $routes->get('patients', 'Doctor::patients');
    $routes->get('patientHistory', 'Doctor::patientHistory');
    $routes->get('patient_profile/(:num)', 'Doctor::patientProfile/$1');
    $routes->get('profile', 'Doctor::profile');
    $routes->post('profile/toggle-status', 'Doctor::toggleStatus');
    $routes->get('historyDetail', 'Doctor::historyDetail');
    $routes->get('chat', 'Doctor::chat');
    $routes->post('accept_appointment', 'Doctor::acceptAppointment');
    $routes->post('reject_appointment', 'Doctor::rejectAppointment');
    $routes->post('end_consultation', 'Doctor::endConsultation');
    $routes->get('prescription_form', 'Doctor::prescriptionForm');
    $routes->post('write_prescription', 'Doctor::writePrescription');
    $routes->get('schedules', 'Doctor::schedules');
    $routes->post('updateSchedule', 'Doctor::updateSchedule');
});

$routes->group('pharmacy', ['filter' => ['auth', 'role:farmasi']], static function ($routes) {
    $routes->get('/', 'Pharmacy::index');
    $routes->post('update_status', 'Pharmacy::updateStatus');
});

$routes->group('admin', ['filter' => ['auth', 'role:admin']], static function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('users', 'Admin::users');
    $routes->get('transactions', 'Admin::transactions');
    
    $routes->get('doctors', 'Admin::doctors');
    $routes->post('doctors/add', 'Admin::addDoctor');
    $routes->post('doctors/verify', 'Admin::verifyDoctor');
    $routes->get('patients', 'Admin::patients');
    $routes->get('patients/detail/(:num)', 'Admin::patientDetail/$1');
    
    $routes->get('specializations', 'Admin::specializations');
    $routes->post('specializations/add', 'Admin::addSpecialization');
    
    $routes->get('logs', 'Admin::logs');
});
