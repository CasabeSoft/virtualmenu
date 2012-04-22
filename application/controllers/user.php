<?php

/**
 * Controlador para la gestión de usuarios.
 * 
 * @author Leoanrdo Quintero
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * Mostrar usuarios.
     *
     * Nota: Funcionalidad futura, que un administrador gestione los usuarios.
     */
    public function index() {
        /*
        if (!isLogged()) {
            redirect('autenticar');
            exit;
        }
        $data['title'] = 'Menu Virtual - Usuarios';
        $data['viewToLoad'] = 'usuarios';
        $this->load->view('comunes/mainUser', $data);
         */
    }
    
    /**
     *  Formulario para validar el acceso de un usuario.
     */
    function autenticar() {
        $data['title'] = 'Menu Virtual - Autenticar';
        $data['viewToLoad'] = 'autenticar';
        $this->load->view('comunes/mainUser', $data);
    }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
