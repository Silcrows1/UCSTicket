<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['assigned/(:any)'] = 'tickets/viewassigned/$1';
$route['tickets/search_category'] = 'tickets/search_category';
$route['tickets/search'] = 'tickets/search';
$route['createT'] = 'tickets/createT';
$route['createG'] = 'tickets/createG';
$route['general'] = 'tickets/general';
$route['technical'] = 'tickets/technical';
$route['options'] = 'tickets/options';
$route['archive'] = 'tickets/archive';
$route['itassets/delete/(:any)'] = 'itassets/deleteasset/$1';
$route['users/delete/(:any)'] = 'users/deleteuser/$1';
$route['users/view/(:any)'] = 'users/viewuser/$1';
$route['tickets/edit/(:any)'] = 'tickets/viewtoedit/$1';
$route['tickets/(:any)'] = 'tickets/view/$1';
$route['tickets'] ='tickets/index';
$route['createt'] ='tickets/createt';
$route['createg'] ='tickets/createg';
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
