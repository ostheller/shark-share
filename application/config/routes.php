<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// These are the reserved routes
// $route['default_controller'] = "users";
// $route['404_override'] = '';

////////////////////////// Load Pages //////////////////////////////////////

// [All the routes below lead to functions that control privacy, i.e. if logged in or not]
// Load the user dashboard
// $route['dashboard'] = 'users/view_user_dashboard';
// // Load the admin dashboard
// $route['admin'] = 'users/view_admin_dashboard';
// // Load the search page [from browse or typing in url, not showing search results]
// $route['search'] = 'samples/browse';
// // Load the upload page
// $route['upload'] = 'sample/view_upload_page';
// // Load the checkout/email page
// $route['checkout'] = 'samples/view_checkout';
// // Load a sample profile page
// $route['sample/(:num)'] = 'samples/view_sample/$1';
// // Load a person profile page
// $route['user/(:any)'] = 'users/view_user/$1';
// // Load a collection page
// $route['collection/(:any)'] = 'samples/view_collection/$1';

////////////////////////// Process Forms //////////////////////////////////////

$route['default_controller'] = 'pages';
$route['(:any)'] = 'pages/view/$1';

?>