<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'welcome';
$route['default_controller'] 	= 'user';
$route['404_override'] 			= '';
$route['translate_uri_dashes'] 	= FALSE;

$route['admin/users'] 					= 'admin/list_users';
$route['admin/settings'] 				= 'admin/settings';
$route['admin/user/add'] 				= 'admin/add_user';
$route['admin/user/edit/(:num)'] 		= 'admin/edit_user/$1';
$route['admin/user/delete/(:num)'] 		= 'admin/delete_user/$1';
$route['admin/user/check_email_exists'] = 'admin/check_email_exists';
$route['admin/request/list']			= 'admin/request_list';
$route['admin/request/view/(:num)'] 	= 'admin/request_details/$1';
$route['admin/process/request']			= 'admin/process_request';
$route['admin/report/generate']			= 'admin/generate_report';

//company
$route['admin/company/list']			= 'admin/company_list';
$route['admin/company/create']			= 'admin/company_create';
$route['admin/company/update/(:num)']	= 'admin/company_udpate/$1';
$route['admin/company/delete/(:num)']	= 'admin/company_delete/$1';

//estimates
$route['admin/estimates/list']			= 'estimates/estimate_list';
$route['admin/estimates/create']		= 'estimates/estimate_create';
$route['admin/estimates/update/(:num)']	= 'estimates/estimate_udpate/$1';
$route['admin/estimates/delete/(:num)']	= 'estimates/estimate_delete/$1';
$route['admin/estimates/views/(:num)']	= 'estimates/estimate_view/$1';
$route['admin/estimates/export/(:num)'] = 'estimates/estimate_export/$1';
$route['admin/estimates/clone/(:num)'] = 'estimates/estimate_clone/$1';

//clients
$route['admin/clients/list']			= 'clients/clients_list';
$route['admin/clients/create']			= 'clients/clients_create';
$route['admin/clients/update/(:num)']	= 'clients/clients_update/$1';
$route['admin/clients/delete/(:num)']	= 'clients/clients_delete/$1';


//items
$route['admin/items/list']			= 'items/items_list';
$route['admin/items/create']		= 'items/items_create';
$route['admin/items/update/(:num)']	= 'items/items_update/$1';
$route['admin/items/delete/(:num)']	= 'items/items_delete/$1';
$route['admin/items/getItems'] 		= 'items/getItems';
$route['admin/items/getItemDetails'] = 'items/getItemDetails';

//user
$route['user/requests/create']			= 'user/request_create';
$route['user/requests'] 				= 'user/request_list';
$route['user/request/view/(:num)'] 	    = 'user/request_details/$1';
$route['user/report/generate']			= 'user/generate_report';