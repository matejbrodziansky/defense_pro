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
$route['default_controller'] 					= 'main';
$route['stratene-heslo'] 						= 'Admin/auth/lostPassword';
$route['autentifikacia'] 						= 'Admin/auth/twoFactorAuth';
$route['auth'] 									= 'Admin/auth';
$route['admin'] 								= 'Admin/admin';
$route['login'] 								= 'Admin/auth';
$route['logout'] 								= 'Admin/auth/logout';
$route['admin/profile'] 						= 'Admin/admin/profile';
$route['admin/dashboard'] 						= 'Admin/dashboard/index';
$route['admin/dashboard/timeline'] 				= 'Admin/dashboard/timeline';
$route['admin/employees'] 						= 'Admin/employees/index';
$route['admin/employees/add'] 					= 'Admin/employees/add';
$route['admin/employees/edit/(:num)'] 			= 'Admin/employees/edit/$1';
$route['admin/employees/delete/(:num)'] 		= 'Admin/employees/delete/$1';
$route['admin/objects'] 						= 'Admin/objects/index';
$route['admin/objects/add'] 					= 'Admin/objects/add';
$route['admin/objects/createObjectReport'] 					= 'Admin/objects/createObjectReport';
$route['admin/objects/edit/(:num)'] 			= 'Admin/objects/edit/$1';
$route['admin/objects/createScheduleEmployeesPreview/(:num)/(:num)/(:num)'] 			= 'Admin/objects/createScheduleEmployeesPreview/$1/$2/$3';
$route['admin/objects/sendScheduleToEmployeesByEmail'] 			= 'Admin/objects/sendScheduleToEmployeesByEmail';
$route['admin/objects/delete/(:num)'] 		    = 'Admin/objects/delete/$1';
$route['admin/objects/delete_report/(:num)'] 		    = 'Admin/objects/delete_report/$1';
$route['admin/objects/delete_report/(:num)']    = 'Admin/objects/deleteObjectReport/$1';
$route['admin/objects/detail/(:num)'] 		    = 'Admin/objects/detail/$1';
$route['admin/objects/exportSchedule/(:num)'] 	= 'Admin/objects/exportSchedule/$1';
$route['admin/objects/exportDetail/(:num)'] 	= 'Admin/objects/exportDetail/$1';
$route['admin/objects/createObjectReportPreview/(:num)'] 	= 'Admin/objects/createObjectReportPreview/$1';
$route['admin/objects/shift-work/(:num)'] 		= 'Admin/shift_work/index/$1';
$route['admin/objects/shift-work/(:num)/ajaxGetShiftWorkList'] 		= 'Admin/shift_work/ajaxGetShiftWorkList/$1';
$route['admin/objects/shift-work/(:num)/update'] 					= 'Admin/shift_work/update/$1';
$route['admin/objects/shift-work/(:num)/delete'] 					= 'Admin/shift_work/delete/$1';
$route['admin/for-sending'] 					= 'Admin/control/index_for_sending';
$route['admin/invoicing'] 					    = 'Admin/control/index_invoicing';
$route['admin/control/sendControlItemReportByEmail'] 						= 'Admin/control/sendControlItemReportByEmail';
$route['admin/control/changeCaptureControlState'] 						    = 'Admin/control/changeCaptureControlState';
$route['admin/control/changeCleanupControlState'] 						    = 'Admin/control/changeCleanupControlState';
$route['admin/control/changeObjectControlState'] 						    = 'Admin/control/changeObjectControlState';
$route['admin/control/setCommentInvoicing'] 						        = 'Admin/control/setCommentInvoicing';
$route['admin/demands'] 						= 'Admin/demands/index';
$route['admin/demands/add'] 					= 'Admin/demands/add';
$route['admin/demands/edit/(:num)'] 			= 'Admin/demands/edit/$1';
$route['admin/demands/delete/(:num)'] 		    = 'Admin/demands/delete/$1';
$route['admin/demands/detail/(:num)'] 		    = 'Admin/demands/detail/$1';
$route['admin/demands/ajaxGetDemandDetail/(:num)'] = 'Admin/demands/ajaxGetDemandDetail/$1';
$route['admin/daily_demands'] 						= 'Admin/daily_demands/index';
$route['admin/daily_demands/add'] 					= 'Admin/daily_demands/add';
$route['admin/daily_demands/edit/(:num)'] 			= 'Admin/daily_demands/edit/$1';
$route['admin/daily_demands/delete/(:num)'] 		    = 'Admin/daily_demands/delete/$1';
$route['admin/daily_demands/detail/(:num)'] 		    = 'Admin/daily_demands/detail/$1';
$route['admin/daily_demands/ajaxGetDailyDemandDetail/(:num)'] = 'Admin/daily_demands/ajaxGetDailyDemandDetail/$1';
$route['admin/captures'] 						= 'Admin/captures/index';
$route['admin/captures/add'] 					= 'Admin/captures/add';
$route['admin/captures/edit/(:num)'] 			= 'Admin/captures/edit/$1';
$route['admin/captures/delete/(:num)'] 		    = 'Admin/captures/delete/$1';
$route['admin/captures/pdf/(:num)'] 		    = 'Admin/captures/pdf/$1';
$route['admin/captures/createCaptureReportPreview/(:num)'] 	= 'Admin/captures/createCaptureReportPreview/$1';
$route['admin/cleanups'] 						= 'Admin/cleanups/index';
$route['admin/cleanups/add'] 					= 'Admin/cleanups/add';
$route['admin/cleanups/edit/(:num)'] 			= 'Admin/cleanups/edit/$1';
$route['admin/cleanups/delete/(:num)'] 		    = 'Admin/cleanups/delete/$1';
$route['admin/cleanups/pdf/(:num)'] 		    = 'Admin/cleanups/pdf/$1';
$route['admin/cleanups/createCleanupReportPreview/(:num)'] 	= 'Admin/cleanups/createCleanupReportPreview/$1';
$route['admin/clients'] 						= 'Admin/clients/index';
$route['admin/clients/add'] 					= 'Admin/clients/add';
$route['admin/clients/edit/(:num)'] 			= 'Admin/clients/edit/$1';
$route['admin/clients/delete/(:num)'] 		    = 'Admin/clients/delete/$1';
$route['admin/clients/detail/(:num)'] 		    = 'Admin/clients/detail/$1';
$route['admin/clients/show-document/(:num)/(:any)/(:any)'] = 'Admin/clients/fileDisplay/$1/$2/$3';
$route['admin/stats'] 							= 'Admin/stats/index';
$route['admin/wages'] 							= 'Admin/wages/index';
$route['admin/wages/export'] 					= 'Admin/wages/export';
$route['admin/wages/detail/(:num)'] 			= 'Admin/wages/detail/$1';
$route['admin/wages/exportDetail/(:num)'] 		= 'Admin/wages/exportDetail/$1';
$route['admin/wages/createWageDetailPDF/(:num)'] 		= 'Admin/wages/createWageDetailPDF/$1';
$route['admin/users'] 							= 'Admin/users/index';
$route['admin/users/add'] 						= 'Admin/users/add';
$route['admin/users/edit/(:num)'] 				= 'Admin/users/edit/$1';
$route['admin/users/delete/(:num)'] 			= 'Admin/users/delete/$1';
$route['admin/traffic'] 						= 'Admin/traffic/index';
$route['admin/traffic/create'] 					= 'Admin/traffic/create';
$route['admin/traffic/edit/(:num)'] 			= 'Admin/traffic/edit/$1';
$route['admin/traffic/delete/(:num)'] 			= 'Admin/traffic/delete/$1';
$route['admin/traffic/show_pdf'] 			    = 'Admin/traffic/show_pdf';
$route['admin/traffic/show_final_pdf/(:num)']   = 'Admin/traffic/show_final_pdf/$1';
$route['admin/traffic/pdf/(:num)'] 		        = 'Admin/traffic/pdf/$1';
$route['404_override'] 							= '';
$route['translate_uri_dashes'] = FALSE;
