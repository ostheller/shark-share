<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// These are the reserved routes
$route['default_controller'] = "logins";
$route['404_override'] = '';

////////////////////////// Landing page //////////////////////////////////////
// NB: Load the landing page == the default route (includes the form to login)
// User submits the login form
$route['login'] = 'logins/login_validation';
// User clicks on register
$route['register'] = 'logins/registration_page';
// User submits registration form
$route['validate'] = 'logins/registration_validation';
// Logout the user (end up back on the landing page)
$route['logout'] = 'logins/logout';

// User clicks on the help page
$route['help'] = 'users/view_help';

// User tries to access a page they don't have permission to see
$route['restricted'] = 'users/restricted';

////////////////////////// Setup Account //////////////////////////////////////
// The new user gets to set up their account
$route['user/new'] = 'users/setup_profile';

////////////////////////// Admin Dashboard //////////////////////////////////////
// Load the admin dashboard
$route['admin'] = 'admins/view_admin_dashboard';
// View more information about a new user
// Accept a user
// Deny a user

////////////////////////// User Dashboard //////////////////////////////////////
// Load the admin dashboard
$route['dashboard'] = 'users/view_user_dashboard';

////////////////////////// Search Page //////////////////////////////////////
// Load the search page [from browse or typing in url, not showing search results]
$route['search'] = 'samples/browse';

////////////////////////// Upload Page //////////////////////////////////////
// Load the upload page
$route['upload/success'] = 'collections/upload_success';
$route['upload/submit'] = 'collections/submit_data';
$route['upload'] = 'collections/view_upload_page';

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