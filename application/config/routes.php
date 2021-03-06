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
$route['download/terms'] = 'logins/download_terms';
// User submits terms of service form
$route['register/accept'] = 'logins/terms_confirmation';
// User passes terms form, goes to final page
$route['register/complete'] = 'logins/visit_welcome_page';
// Logout the user (end up back on the landing page)
$route['logout'] = 'logins/logout';
// Reset the user's password
$route['reset'] = 'logins/reset_password';
// Temporary methods to edit the second and third registration pages
$route['edit/two'] = 'logins/view_registration_two';
$route['edit/three'] = 'logins/view_registration_three';
// Temporary methods to edit the edit profile page
$route['edit/profile_page'] = 'logins/view_edit_profile';

////////////////////////// Setup Account //////////////////////////////////////
// The new user gets to set up their account
$route['setup_user/(:any)'] = 'users/view_setup_profile/$1';
// Submit the form for setting their profile information
$route['setup/submit'] = 'users/create_profile';
// Submit the form for setting their tag preferences
$route['setup/tags'] = 'users/create_tags';

////////////////////////// Admin Dashboard //////////////////////////////////////
// Load the admin dashboard
$route['admin'] = 'admins/view_admin_dashboard';
// View potential users
$route['admin/view/potential_users'] = 'admins/view_potential_users';
// Accept a user
$route['admin/admit/potential_users'] = 'admins/confirm_new_user';
// Deny a user
$route['admin/reject/potential_users'] = 'admins/reject_potential_user';

////////////////////////// User Dashboard //////////////////////////////////////
// Load the admin dashboard
$route['dashboard'] = 'users/view_user_dashboard';

////////////////////////// Search Page //////////////////////////////////////
// Load the search page from browse or typing in url, not showing search results]
$route['browse'] = 'samples/browse';
// Ajax call for tagged data
$route['autofill/tags'] = 'samples/get_tags';
// Process the search form data & view the page
$route['search'] = 'samples/search';
$route['autofill/genus'] = 'samples/get_genus';
$route['autofill/species'] = 'samples/get_species';
$route['autofill/family'] = 'samples/get_family';
$route['autofill/order'] = 'samples/get_order';
// Add samples to the basket
$route['samples/request'] = 'requests/request';

////////////////////////// Upload Page //////////////////////////////////////
// Load the upload page
$route['upload'] = 'collections/view_upload_page';
// Submit the form to  upload the excel document into the assets folder
$route['upload/submit'] = 'collections/upload_batch';
// Excel sheet upload was successful, pull data and view for confirmation
$route['upload/success'] = 'collections/upload_success';
// Submit the form to db
$route['upload/submit/final'] = 'collections/submit_data';

////////////////////////// Taxonomy Page //////////////////////////////////////
// Load the taxonomy page
$route['taxonomy'] = 'taxonomies/view_taxonomy';
// View current taxonomy
$route['taxonomy/view'] = 'taxonomies/show_taxonomy';
// Submit the form to upload the excel document into the assets folder
$route['taxonomy/submit'] = 'taxonomies/upload_batch';
// Excel sheet upload was successful, pull data and view for confirmation
$route['taxonomy/success'] = 'taxonomies/upload_success';
// Submit the form to db
$route['taxonomy/submit/final'] = 'taxonomies/submit_taxonomy_data';
// Update taxonomy data
$route['taxonomy/update'] = 'taxonomies/update_data';
// Delete taxonomy row
$route['taxonomy/delete'] = 'taxonomies/delete_data';

////////////////////////// Request Samples Page //////////////////////////////////////
// Load the request samples page
$route['request'] = 'requests/view_request_sample_page';
// Load the requests data
$route['request/samples'] = 'requests/samples';
// Load the count of requests
$route['request/count'] = 'requests/count_requests';
// Remove requests
$route['request/delete'] = 'requests/remove_requests';
// Get contributers
$route['request/select_contributer'] = 'requests/get_contributers';
// Get data to compose email
$route['request/email'] = 'requests/compose_email_data';
// Post the finalized data and send the email!
$route['request/send'] = 'requests/send_email';
// Load pending requests data
$route['request/pending'] = 'requests/pending_requests';


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
// Submit the form to edit a user
$route['update/user'] = 'users/update/$1';

////////////////////////// Collection Page //////////////////////////////////////
// Load a collection page
$route['collection/(:any)'] = 'collections/view_collection/$1';
// Load the json data for a collection page
$route['data/collection/(:any)'] = 'collections/get_data/$1';
// Choosing samples to delete uses the method on the samples controller above

////////////////////////// About, FYI, Restricted //////////////////////////////////////
// User clicks on the about page
$route['about'] = 'pages/view_about';
// User clicks on the help page
$route['help'] = 'pages/view_help';
// User tries to access a page they don't have permission to see
$route['restricted'] = 'pages/restricted';

?>