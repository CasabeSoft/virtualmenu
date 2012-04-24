<?php

/**
 * Controlador prueba CRUD.
 * 
 * @author Leoanrdo Quintero
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdministratorController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('grocery_CRUD');
    }

    public function index() {
        if (!isLogged()) {
            redirect('login');
            exit;
        }
        $data->title = 'Menu Virtual - Inicio administrador';
        $data->viewToLoad = 'administrator/home';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    public function users1() {

        $this->grocery_crud->set_table(USERS);
        $data = $this->grocery_crud->render();

        $data->title = 'Menu Virtual - Usuarios';
        $data->viewToLoad = 'user/user';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    public function users() {

        $crud = new grocery_CRUD();

        //$crud->set_language("french"); 
        $crud->set_theme('datatables');
        $crud->set_table(USERS);
        $crud->set_subject('Usuarios');
        $crud->columns('name', 'phone', 'email');
        $crud->display_as('name', 'Nombre')
                ->display_as('phone', 'Teléfono')
                ->display_as('email', 'Correo')
                ->display_as('password', 'Contraseña');
        $crud->change_field_type('password', 'password');
        $crud->callback_before_insert(array($this, 'encrypt_password_callback'));
        $crud->add_fields('name', 'phone', 'email', 'password');
        $crud->edit_fields('name', 'phone', 'email');
        $data = $crud->render();

        $data->title = 'Menu Virtual - Usuarios';
        $data->viewToLoad = 'user/user';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    function encrypt_password_callback($post_array) {
        $post_array['password'] = md5($post_array['password']);

        return $post_array;
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */