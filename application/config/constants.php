<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
  |--------------------------------------------------------------------------
  | DataBase Table Names
  |--------------------------------------------------------------------------
  |
 */

define('USERS', 'users');
define('CUSTOMERS', 'customers');
define('CUSTOMERS_BY_PROVIDER', 'customers_by_provider');
define('GROUPS', 'groups');
define('GROUP_TYPES', 'group_types');
define('PROVIDERS', 'providers');
define('MANAGERS', 'managers');
define('MANAGERS_BY_PROVIDER', 'managers_by_provider');
define('PRODUCTS', 'products');
define('PRODUCTS_BY_MENU', 'products_by_menu');
define('PRODUCTS_BY_ORDER', 'products_by_order');
define('SECTIONS', 'sections');
define('SECTION_TYPES', 'section_types');
define('MENUS', 'menus');
define('MENU_TYPES', 'menu_types');
define('MENU_TYPES_BY_PROVIDER', 'menu_types_by_provider');
define('ORDERS', 'orders');

/*
  |--------------------------------------------------------------------------
  | User administrator
  |--------------------------------------------------------------------------
  |
 */

define('EMAIL_ADMINISTRATOR', 'admin@admin.com');
define('PASSWORD_ADMINISTRATOR', '202cb962ac59075b964b07152d234b70'); //123

/*
  |--------------------------------------------------------------------------
  | User rol
  |--------------------------------------------------------------------------
  |
 */

define('ROL_ADMINISTRATOR', 1);
define('ROL_MANAGER', 2);
define('ROL_CUSTOMER', 3);


/*
  |--------------------------------------------------------------------------
  | Domain data
  |--------------------------------------------------------------------------
  |
 */

define('DOMAIN_NAME', 'virtualmenu');
define('DOMAIN_URL', 'http://virtualmenu.dev');

/* End of file constants.php */
/* Location: ./application/config/constants.php */