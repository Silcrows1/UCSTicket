<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['users/edit/(:any)'] = 'users/edituser/$1';
$route['tickets/(:any)'] = 'tickets/view/$1';
$route['tickets'] ='tickets/index';
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
