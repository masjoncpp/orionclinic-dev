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
    $routes->get('chat', 'Patient::chat');
    $routes->get('wellness', 'Patient::wellness');
    $routes->post('book_appointment', 'Patient::bookAppointment');
});

$routes->group('doctor', ['filter' => ['auth', 'role:doctor']], static function ($routes) {
    $routes->get('/', 'Doctor::index');
    $routes->get('consultation', 'Doctor::consultation');
    $routes->get('patients', 'Doctor::patients');
    $routes->get('patientHistory', 'Doctor::patientHistory');
    $routes->get('profile', 'Doctor::profile');
    $routes->get('historyDetail', 'Doctor::historyDetail');
    $routes->get('chat', 'Doctor::chat');
    $routes->post('accept_appointment', 'Doctor::acceptAppointment');
    $routes->post('reject_appointment', 'Doctor::rejectAppointment');
    $routes->post('end_consultation', 'Doctor::endConsultation');
    $routes->get('prescription_form', 'Doctor::prescriptionForm');
    $routes->post('write_prescription', 'Doctor::writePrescription');
});
