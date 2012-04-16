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
        $data['title'] = 'Menu Virtual - Inicio';
        $data['viewToLoad'] = 'inicio';
        $this->load->view('comunes/main', $data);
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */