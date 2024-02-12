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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['AboutUs/(:any)'] = 'home/AboutUs/$1';
$route['getAboutContent'] = 'home/getAboutContent';
$route['OurInspiration'] = 'home/OurInspiration';
$route['OurVision'] = 'home/OurVision';
$route['OurObjectives'] = 'home/OurObjectives';
$route['OurActivities'] = 'home/OurActivities';
$route['DownloadPamphlet'] = 'home/DownloadPamphlet';
$route['DownloadForms'] = 'home/DownloadForms';
$route['Gallery'] = 'home/Gallery';
$route['Videos'] = 'home/Videos';
$route['Trustees'] = 'home/Trustees';
$route['Guiding'] = 'home/Guiding';

$route['UserRegister'] = 'home/UserRegister';
$route['Profile'] = 'home/Profile';
//$route['UserLogin'] = 'home/UserLogin';
$route['UserLogin'] = 'Auth/login';
$route['login'] = 'Auth/login';
$route['change_password'] = 'home/change_password';
$route['UserLogout'] = 'home/UserLogout';
$route['MyReceipts'] = 'home/MyReceipts';
$route['PrintMyReceipts'] = 'home/PrintMyReceipts';
$route['forgetpassword'] = 'home/forgetpassword';
$route['privacy'] = 'home/privacy_policy';
$route['disclaimer'] = 'home/disclaimer';
$route['terms'] = 'home/terms';
$route['refund'] = 'home/refund_policy';
$route['donate'] = 'home/donate';
$route['polling/(:any)']='home/new_polling';
$route['poll_success']='home/poll_success';
$route['poll_failure']='home/poll_failure';
