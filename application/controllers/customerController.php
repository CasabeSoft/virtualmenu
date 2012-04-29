<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controlador para los clientes.
 * 
 * @author Leoanrdo Quintero
 */
class CustomerController extends CI_Controller {

    function __construct() {
        parent::__construct();       
    }

    /**
     * Página por defecto del controlador.
     *
     */
    public function index() {
        // Verifa si el usuario esta autenticado.
        if (!isLogged()) {
            redirect('login');
            exit;
        }
        $data['title'] = 'Menu Virtual - Inicio cliente';
        $data['viewToLoad'] = 'customer/home';
        $this->load->view('comunes/mainCustomer', $data);
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */