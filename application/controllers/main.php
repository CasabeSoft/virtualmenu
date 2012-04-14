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
     * Maps to the following URL
     * 		http://virtualmenu.dev/
     * 	- or - 
     * 		http://virtualmenu.dev/main
     * 	- or -  
     * 		http://virtualmenu.dev/main/index
     */
    public function index() {
        $datos['title'] = 'Menu Virtual - Inicio';
        $datos['viewToLoad'] = 'inicio';
        $this->load->view('comunes/main', $datos);
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */