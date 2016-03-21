<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// These are the reserved routes
$route['default_controller'] = "users";
$route['404_override'] = '';

////////////////////////// Landing page //////////////////////////////////////
// Load the landing page
$route['logout'] = 'users/logout';

////////////////////////// Admin Dashboard //////////////////////////////////////
// Load the admin dashboard
$route['admin'] = 'users/view_admin_dashboard';

////////////////////////// Search Page //////////////////////////////////////
// Load the search page [from browse or typing in url, not showing search results]
$route['search'] = 'samples/browse';

////////////////////////// Upload Page //////////////////////////////////////
// Load the upload page
$route['upload'] = 'samples/view_upload_page';
$route['upload_success'] = 'samples/upload_success';

////////////////////////// Checkout Page //////////////////////////////////////
// Load the checkout/email page
$route['checkout'] = 'samples/view_checkout';

////////////////////////// Sample Page //////////////////////////////////////
// Load a sample profile page
$route['sample/(:num)'] = 'samples/view_sample/$1';

////////////////////////// User Page //////////////////////////////////////
// Load a person profile page
$route['user/(:any)'] = 'users/view_user/$1';

////////////////////////// Collection Page //////////////////////////////////////
// Load a collection page
$route['collection/(:any)'] = 'samples/view_collection/$1';

?>