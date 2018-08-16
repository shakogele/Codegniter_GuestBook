<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['reviews/create'] = 'reviews/create';
$route['reviews/(:any)'] = 'reviews/view/$1';
$route['reviews'] = 'reviews';
$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/view';
