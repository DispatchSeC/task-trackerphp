<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('tasks', 'TaskController::index');
$routes->post('tasks/store', 'TaskController::store');
$routes->get('tasks/delete/(:num)', 'TaskController::delete/$1');
$routes->get('tasks/edit/(:num)', 'TaskController::edit/$1');
$routes->post('tasks/update/(:num)', 'TaskController::update/$1');
$routes->get('tasks/updateStatus/(:num)/(:segment)', 'TaskController::updateStatus/$1/$2');
