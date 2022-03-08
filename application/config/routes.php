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
$route['AP'] = 'AP';
$route['ap'] = 'AP';
$route['AR'] = 'AR';
$route['ar'] = 'AR';
$route['cashadvance'] = 'Cash_adv';

// * Direct Purchase
$route['purchase/direct_purchase']['get'] = 'ABC/C_DirectPurchase';
$route['purchase/direct_purchase/new'] = 'ABC/C_DirectPurchase/get_direct_purchase_form';
$route['purchase/direct_purchase/detail/(:num)']['get'] = 'ABC/C_DirectPurchase/view_direct_purchase_detail/$1';

// * Purchase
$route['ajax/abc/purchase/direct_purchase']['get'] = 'ABC/C_DirectPurchase/get_direct_purchase';

// * AJAX Route
$route['ajax/report/wo'] = 'C_Report/ajax_get_wo_data';
$route['ajax/report/invoice'] = 'C_Report/ajax_get_sales_by_invoice_data';
$route['ajax/report/sales'] = 'C_Report/ajax_get_sales_data';
$route['ajax/report/purchase'] = 'C_Report/ajax_get_purchase_data';
$route['ajax/report/receipt'] = 'C_Report/ajax_get_inventory_receipt_data';
$route['ajax/report/issued'] = 'C_Report/ajax_get_inventory_issued_data';
$route['ajax/report/reorder'] = 'C_Report/ajax_get_reorder_data';

$route['ajax/dashboard/assembly/standardjob'] = 'C_AssemblyDashboard/ajax_get_standard_job';

$route['ajax/master/abc/type']['get'] = 'ABC/C_Master/get_type';
$route['ajax/master/abc/group']['get'] = 'ABC/C_Master/get_type_group';
$route['ajax/master/abc/percentage']['get'] = 'ABC/C_Master/get_group_percentage';
$route['ajax/master/abc/point']['get'] = 'ABC/C_Master/get_point';
$route['ajax/master/abc/content/percentage/(:num)']['get'] = 'ABC/C_Master/get_group_percentage_table/$1';

$route['ajax/select2/abc/type']['get'] = 'ABC/C_Master/get_type_select2';
$route['ajax/select2/abc/group']['get'] = 'ABC/C_Master/get_group_select2';
$route['ajax/select2/abc/customer']['get'] = 'ABC/C_SalesOrder/get_customer_select2';
$route['ajax/select2/abc/storage']['get'] = 'ABC/C_SalesOrder/get_storage_select2';
$route['ajax/select2/abc/stockcode']['get'] = 'ABC/C_SalesOrder/get_stockcode_select2';
$route['ajax/select2/abc/purchase/stockcode']['get'] = 'ABC/C_DirectPurchase/get_stockcode_select2';
$route['ajax/select2/abc/currency']['get'] = 'ABC/C_SalesOrder/get_currency_select2';
$route['ajax/select2/abc/bank']['get'] = 'ABC/C_SalesOrder/get_bank_select2';
$route['ajax/select2/abc/supplier']['get'] = 'ABC/C_DirectPurchase/get_supplier_select2';
$route['ajax/select2/abc/costcenter']['get'] = 'ABC/C_DirectPurchase/get_cost_center_select2';
$route['ajax/select2/abc/accountcode']['get'] = 'ABC/C_DirectPurchase/get_account_code_select2';
$route['ajax/select2/abc/book']['get'] = 'ABC/C_BackOrder/get_book_select2';
$route['ajax/select2/abc/assistance']['get'] = 'ABC/C_Report/get_assistance';
$route['ajax/select2/abc/employee']['get'] = 'ABC/C_Report/get_employee';
$route['ajax/select2/abc/department']['get'] = 'IPH/C_Return/get_department';

$route['404_override'] = 'Financecorp/not_found';
$route['translate_uri_dashes'] = FALSE;