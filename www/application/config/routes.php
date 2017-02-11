<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
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
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

$route['default_controller'] = "maincontroller";
$route['404_override'] = '';

$route["home"] = "maincontroller";

$route["users"] = "usercontroller";
$route["login"] = "usercontroller/login";
$route["register"] = "usercontroller/register";
$route["rememberPassword"] = "usercontroller/rememberPassword";
$route["changePassword"] = "usercontroller/changePassword";
$route["resetPassword/:any"] = "usercontroller/resetPassword/$1";
$route["contact"] = "usercontroller/contact";
$route["profile"] = "usercontroller/profile";
$route["denied"] = "usercontroller/denied";
$route["exit"] = "usercontroller/close";

$route["customer"] = "customercontroller";

$route["manager"] = "managercontroller";

$route["administrator"] = "administratorcontroller";

$route["administrator/users1"] = "administratorcontroller/users1";
$route["administrator/users1/:any"] = "administratorcontroller/users1/$1";

$route["administrator/users"] = "administratorcontroller/users";
$route["administrator/users/:any"] = "administratorcontroller/users/$1";

$route["administrator/group_types"] = "administratorcontroller/groupTypes";
$route["administrator/group_types/:any"] = "administratorcontroller/groupTypes/$1";

$route["administrator/groups"] = "administratorcontroller/groups";
$route["administrator/groups/:any"] = "administratorcontroller/groups/$1";

$route["administrator/customers"] = "administratorcontroller/customers";
$route["administrator/customers/:any"] = "administratorcontroller/customers/$1";

$route["administrator/managers"] = "administratorcontroller/managers";
$route["administrator/managers/:any"] = "administratorcontroller/managers/$1";

$route["administrator/providers"] = "administratorcontroller/providers";
$route["administrator/providers/:any"] = "administratorcontroller/providers/$1";

$route["administrator/products"] = "administratorcontroller/products";
$route["administrator/products/:any"] = "administratorcontroller/products/$1";

$route["administrator/menus"] = "administratorcontroller/menus";
$route["administrator/menus/:any"] = "administratorcontroller/menus/$1";

$route["administrator/menu_types"] = "administratorcontroller/menuTypes";
$route["administrator/menu_types/:any"] = "administratorcontroller/menuTypes/$1";

$route["administrator/sections"] = "administratorcontroller/sections";
$route["administrator/sections/:any"] = "administratorcontroller/sections/$1";

$route["administrator/section_types"] = "administratorcontroller/sectionTypes";
$route["administrator/section_types/:any"] = "administratorcontroller/sectionTypes/$1";

$route["manager/products"] = "managercontroller/products";
$route["manager/products/:any"] = "managercontroller/products/$1";

$route["menu/manage"] = "menuofthedaycontroller/manage";
$route["menu/order"] = "menuofthedaycontroller/order";
$route["menu/order/confirm"] = "menuofthedaycontroller/confirm";

/* End of file routes.php */
/* Location: ./application/config/routes.php */
