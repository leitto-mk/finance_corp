<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

$route['default_controller'] = 'Financecorp';
$route['Finance'] = 'Financecorp';
$route['finance'] = 'Financecorp';
$route['Entry'] = 'Entry/view_receipt_voucher';
$route['entry'] = 'Entry/view_receipt_voucher';
$route['cashadvance'] = 'Cash_adv';

$route['404_override'] = 'Financecorp/not_found';

// * Direct Purchase
$route['purchase/direct_purchase']['get'] = 'ABC/C_DirectPurchase';
$route['purchase/direct_purchase/new'] = 'ABC/C_DirectPurchase/get_direct_purchase_form';

// * Purchase
$route['ajax/abc/purchase/direct_purchase']['get'] = 'ABC/C_DirectPurchase/get_direct_purchase';

$route['translate_uri_dashes'] = FALSE;