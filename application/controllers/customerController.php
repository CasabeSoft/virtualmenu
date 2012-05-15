<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controlador para los clientes.
 * 
 * @author Leoanrdo Quintero
 */
class CustomerController extends MY_Controller {

    function __construct() {
        parent::__construct();
        if (!isLogged()) {
            redirect('login');
            exit;
        }
        if (!userHasPermition(ROL_CUSTOMER)) {
            redirect('denied');
            exit;
        }
    }

    /**
     * Página por defecto del controlador.
     */
    public function index() {
        $data['title'] = 'Menu Virtual - Inicio cliente';
        $data['viewToLoad'] = 'customer/home';
        $this->load->view('comunes/mainCustomer', $data);
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */