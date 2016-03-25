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
$route['register/validate'] = 'logins/registration_validation';
// User passes registration, goes to next page
$route['register/terms'] = 'logins/view_terms';
// User submits terms of service form
$route['register/accept'] = 'logins/terms_confirmation';
// User passes terms form, goes to final page
$route['register/complete'] = 'logins/visit_welcome_page';
// Logout the user (end up back on the landing page)
$route['logout'] = 'logins/logout';

// User clicks on the help page
$route['help'] = 'users/view_help';

// User tries to access a page they don't have permission to see
$route['restricted'] = 'users/restricted';

////////////////////////// Setup Account //////////////////////////////////////
// The new user gets to set up their account
$route['user/new'] = 'users/view_setup_profile';
// Submit the form for setting their preferences
$route['user/new/submit'] = 'users/create_profile';

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
$route['upload'] = 'collections/view_upload_page';
// Submit the form to  upload the excel document into the assets folder
$route['upload/submit'] = 'collections/upload_batch';
// Excel sheet upload was successful, pull data and view for confirmation
$route['upload/success'] = 'collections/upload_success';
// Submit the form to
$route['upload/submit/final'] = 'collections/submit_data';

////////////////////////// Checkout Page //////////////////////////////////////
// Load the checkout/email page
$route['checkout'] = 'samples/view_checkout';

////////////////////////// Sample Page //////////////////////////////////////
// Load a sample profile page
$route['samples/(:num)'] = 'samples/view_sample/$1';
// Submit the form to edit a sample
$route['samples/(:num)/update'] = 'samples/update/$1';
// Delete a sample
$route['samples/delete/(:num)'] = 'samples/delete/$1';

////////////////////////// User Page //////////////////////////////////////
// Load a person profile page
$route['user/(:any)'] = 'users/view_user/$1';

////////////////////////// Collection Page //////////////////////////////////////
// Load a collection page
$route['collection/(:any)'] = 'collections/view_collection/$1';
// Choosing samples to delete uses the method on the samples controller above

?>