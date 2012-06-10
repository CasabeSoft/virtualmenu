<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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

$route['default_controller'] = "mainController";
$route['404_override'] = '';

$route["home"] = "mainController";

$route["users"] = "userController";
$route["login"] = "userController/login";
$route["register"] = "userController/register";
$route["rememberPassword"] = "userController/rememberPassword";
$route["changePassword"] = "userController/changePassword";
$route["resetPassword/:any"] = "userController/resetPassword/$1";
$route["contact"] = "userController/contact";
$route["profile"] = "userController/profile";
$route["denied"] = "userController/denied";
$route["exit"] = "userController/close";

$route["customer"] = "customerController";

$route["manager"] = "managerController";

$route["administrator"] = "administratorController";

$route["administrator/users1"] = "administratorController/users1";
$route["administrator/users1/:any"] = "administratorController/users1/$1";

$route["administrator/users"] = "administratorController/users";
$route["administrator/users/:any"] = "administratorController/users/$1";

$route["administrator/group_types"] = "administratorController/groupTypes";
$route["administrator/group_types/:any"] = "administratorController/groupTypes/$1";

$route["administrator/groups"] = "administratorController/groups";
$route["administrator/groups/:any"] = "administratorController/groups/$1";

$route["administrator/customers"] = "administratorController/customers";
$route["administrator/customers/:any"] = "administratorController/customers/$1";

$route["administrator/managers"] = "administratorController/managers";
$route["administrator/managers/:any"] = "administratorController/managers/$1";

$route["administrator/providers"] = "administratorController/providers";
$route["administrator/providers/:any"] = "administratorController/providers/$1";

$route["administrator/products"] = "administratorController/products";
$route["administrator/products/:any"] = "administratorController/products/$1";

$route["administrator/menus"] = "administratorController/menus";
$route["administrator/menus/:any"] = "administratorController/menus/$1";

$route["administrator/menu_types"] = "administratorController/menuTypes";
$route["administrator/menu_types/:any"] = "administratorController/menuTypes/$1";

$route["administrator/sections"] = "administratorController/sections";
$route["administrator/sections/:any"] = "administratorController/sections/$1";

$route["administrator/section_types"] = "administratorController/sectionTypes";
$route["administrator/section_types/:any"] = "administratorController/sectionTypes/$1";

$route["manager/products"] = "managerController/products";
$route["manager/products/:any"] = "managerController/products/$1";

$route["menu/manage"] = "MenuOfTheDayController/index";

/* End of file routes.php */
/* Location: ./application/config/routes.php */
