<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// These are the reserved routes
$route['default_controller'] = "logins";
$route['404_override'] = '';

////////////////////////// Landing page //////////////////////////////////////
// Load the landing page == the default route, includes the form to login
// Logout the user
$route['logout'] = 'logins/logout';

////////////////////////// Admin Dashboard //////////////////////////////////////
// Load the admin dashboard
$route['admin'] = 'users/view_admin_dashboard';

////////////////////////// User Dashboard //////////////////////////////////////
// Load the admin dashboard
$route['dashboard'] = 'users/view_user_dashboard';

////////////////////////// Search Page //////////////////////////////////////
// Load the search page [from browse or typing in url, not showing search results]
$route['search'] = 'samples/browse';

////////////////////////// Upload Page //////////////////////////////////////
// Load the upload page
$route['upload/success'] = 'samples/upload_success';
$route['upload/submit'] = 'samples/submit_data';
$route['upload'] = 'samples/view_upload_page';

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