<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/cabanas', 'Cabana::index');
$routes->get('reservar/(:any)', 'Reserva::crear/$1');
$routes->post('reservar/guardar', 'Reserva::guardar');
$routes->get('reservas', 'Reserva::misReservas');
$routes->get('mis-reservas', 'Reserva::misReservas');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::loginPost');
$routes->get('logout', 'Auth::logout');
$routes->get('registro', 'Auth::registro');
$routes->post('registro', 'Auth::guardarUsuario');