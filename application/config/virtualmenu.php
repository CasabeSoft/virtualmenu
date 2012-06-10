<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Configuración básica para Menu Virtual.
 * 
 * @author Leonardo
 */
/**
 * Correo.
 * */
$config['email']['protocol'] = 'smtp'; // mail, sendmail, smtp
$config['email']['smtp_host'] = 'smtp.telefonica.net';
$config['email']['smtp_port'] = '25';
$config['email']['smtp_user'] = 'er_company@telefonica.net';
$config['email']['smtp_pass'] = 'mig69cyn';
$config['email']['mailtype'] = 'html'; // text, html
$config['email']['charset'] = 'utf-8'; // utf-8, iso-8859-1, ...
$config['email']['wordwrap'] = FALSE; // TRUE, FALSE

/**
 * Temas para el grocery crud
 * Value: datatables, flexigrid
 */
$config['grocery_crud_theme'] = 'datatables';

/* End of file virtualmenu.php */
/* Location: ./system/application/config/virtualmenu.php */