<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controlador para el gestor.
 * 
 * @author Leoanrdo Quintero
 */
class Reports extends MY_Controller {

    function __construct() {
        parent::__construct();
        if (!isLogged()) {
            redirect('login');
            exit;
        }
        if (!userHasPermition(ROL_MANAGER)) {
            redirect('denied');
            exit;
        }
    }

    /**
     * Página por defecto del controlador.
     */
    public function index() {
        $data['title'] = 'Menu Virtual - Reportes';
        $data['viewToLoad'] = 'reports/index';
        $this->load->view('comunes/mainManager', $data);
    }

    public function dayresume() {
        $data['title'] = 'Menu Virtual - Reportes - Resumen del día';
        $data['viewToLoad'] = 'reports/index';
        $data['report'] = 'reports/dayresume';
        $this->load->view('comunes/mainManager', $data);
    }
    
    public function weekresume() {
        $this->index();
    }

    public function monthresume() {
        $this->index();
    }
    
    public function daydetail() {
        $data['title'] = 'Menu Virtual - Reportes - Detalles del día';
        $data['viewToLoad'] = 'reports/index';
        $data['report'] = 'reports/daydetail';
        $this->load->view('comunes/mainManager', $data);
    }

    public function clients() {
        $this->index();
    }
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */