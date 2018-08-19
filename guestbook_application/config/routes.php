<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';

$route['admin/profile'] = 'admin/view_profile';

$route['admin/update_review'] = 'admin/update_review';
$route['admin/change_review'] = 'admin/change_review';
$route['admin/reviews'] = 'admin/reviews';
$route['admin/reviews/(:any)'] = 'admin/reviews/$1';

$route['admin/edit_review/(:any)'] = 'admin/edit_review/$1';

$route['admin/(:any)'] = 'admin/view/$1';
$route['reviews/create'] = 'reviews/create';
$route['reviews/page'] = 'reviews';
$route['reviews/page/(:any)'] = 'reviews';
$route['reviews/(:any)'] = 'reviews/view/$1';
$route['reviews'] = 'reviews';
$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/view';
