<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['itassets/delete/(:any)'] = 'itassets/deleteasset/$1';
$route['users/delete/(:any)'] = 'users/deleteuser/$1';
$route['users/view/(:any)'] = 'users/viewuser/$1';
$route['tickets/(:any)'] = 'tickets/view/$1';
$route['tickets'] ='tickets/index';
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
