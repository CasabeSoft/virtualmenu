<?php

/**
 * Controlador para los clientes.
 * 
 * @author Leoanrdo Quintero
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ManagerController extends CI_Controller {

    function __construct() {
        parent::__construct();       
    }

    /**
     * Página por defecto del controlador.
     */
    public function index() {
        // Verifa si el usuario esta autenticado.
        if (!isLogged()) {
            redirect('login');
            exit;
        }
        $data['title'] = 'Menu Virtual - Inicio Gestor';
        $data['viewToLoad'] = 'manager/home';
        $this->load->view('comunes/mainManager', $data);
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */