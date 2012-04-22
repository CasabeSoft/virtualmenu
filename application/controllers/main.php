<?php

/**
 * Controlador principal.
 * 
 * @author Leoanrdo Quintero
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('UsersModel');
    }

    /**
     * Página por defecto del controlador.
     *
     * Ej. como utilizar la URL:
     * 		http://virtualmenu.dev/
     * 	- or - 
     * 		http://virtualmenu.dev/main
     * 	- or -  
     * 		http://virtualmenu.dev/main/index
     */
    public function index() {
        //$db = new PDO('sqlite:C:\\Users\\carlos\\Documents\\Proyectos\\VirtualMenu\\src\\db\\virtualmenu.sqlite');
        //$sql = 'SELECT email, name, password FROM users';
        $data['title'] = 'Menu Virtual - Inicio';
        $data['viewToLoad'] = 'home';
        //$data['users'] = $db->query($sql);
        $data['users'] = $this->UsersModel->get_users();
        $this->load->view('comunes/main', $data);
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */