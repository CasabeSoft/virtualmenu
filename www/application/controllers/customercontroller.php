<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controlador para los clientes.
 *
 * @author Leoanrdo Quintero
 */
class CustomerController extends MY_Controller {

    public function __construct() {
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
        $data = array(
          'title' => 'Menu Virtual - Inicio cliente',
          'viewToLoad' => 'customer/home',
        );
        $this->load->view('comunes/maincustomer', $data);
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
