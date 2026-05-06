<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('auth/login', 'Auth::login');
$routes->post('processLogin', 'Auth::processLogin');
$routes->get('logout', 'Auth::logout');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::processRegister');

$routes->get('patient', 'Patient::index');
$routes->get('patient/consultation', 'Patient::consultation');
$routes->get('patient/prescription', 'Patient::prescription');
$routes->get('patient/history', 'Patient::history');
$routes->get('patient/profile', 'Patient::profile');
$routes->get('patient/chat', 'Patient::chat');
$routes->get('patient/wellness', 'Patient::wellness');

$routes->get('doctor', 'Doctor::index');
$routes->get('doctor/consultation', 'Doctor::consultation');
$routes->get('doctor/patients', 'Doctor::patients');
$routes->get('doctor/profile', 'Doctor::profile');
$routes->get('doctor/chat', 'Doctor::chat');
