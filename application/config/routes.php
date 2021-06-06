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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['leads/adminlead'] = 'leads';
$route['leads/adminleadedit'] = 'leads/editleadadmin';
$route['leads/adminleadview'] = 'leads/viewleadadmin';
$route['leads/bdelead'] = 'leads/bde';
$route['leads/bdeleadcreate'] = 'leads/createleadbde';
$route['leads/bdeleadedit'] = 'leads/editleadbde';
$route['leads/uploadlead'] = 'leads/upload';

$route['sales/adminsale'] = 'sales';
$route['sales/adminsalecreate'] = 'sales/createsaleadmin';
$route['sales/adminsaleedit'] = 'sales/editsaleadmin';
$route['sales/adminsaleview'] = 'sales/viewsaleadmin';
$route['sales/bdesale'] = 'sales/bdesale';
$route['sales/bdesalecreate'] = 'sales/createsalebde';
$route['sales/bdesaleedit'] = 'sales/editsalebde';

$route['kyc'] = 'kyc';

$route['riskprofile'] = 'riskprofile';

$route['settings'] = 'settings';
$route['settings/employee'] = 'settings/employee';
$route['settings/addemployee'] = 'settings/addemployee';
$route['settings/employeeprofile'] = 'settings/employeeprofile';
$route['settings/forgetpassword'] = 'settings/forgetpassword';
$route['settings/createfolder'] = 'settings/createfolder';
$route['settings/product'] = 'settings/product';
$route['settings/smtp'] = 'settings/smtp';
$route['settings/salesproduct'] = 'settings/salesproduct';
$route['settings/bankdetails'] = 'settings/bankdetails';
$route['settings/notes'] = 'settings/notes';
$route['settings/dropdown'] = 'settings/dropdown';