<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controlador principal.
 * 
 * @author Leoanrdo Quintero
 */
class MainController extends MY_Controller {

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

        if ($this->providerUriName != DOMAIN_NAME) {
            redirect('login');
            exit();
        }

        $data['title'] = 'Menu Virtual - Inicio';
        $data['viewToLoad'] = 'home';
        $this->load->view('comunes/main', $data);
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */