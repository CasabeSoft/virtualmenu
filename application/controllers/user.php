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
        $this->load->library('form_validation');
        $this->load->model('UsersModel');
    }

    /**
     * Mostrar listado de usuarios.
     *
     * Nota: Funcionalidad futura, que un administrador gestione los usuarios.
     */
    public function index() {
        // Verifa si el usuario esta autenticado.
        if (!isLogged()) {
            redirect('autenticar');
            exit;
        }
        $data['title'] = 'Menu Virtual - Usuarios';
        $data['viewToLoad'] = 'user/user';
        $data['users'] = $this->UsersModel->get_users();
        $this->load->view('comunes/mainCustomer', $data);
    }

    /**
     *  Formulario para validar el acceso de un usuario.
     */
    function login() {

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        //$this->form_validation->set_rules('username', 'Usuario', 'trim|required');
        $this->form_validation->set_rules('email', 'Correo', 'trim|required');
        $this->form_validation->set_rules('password', 'Contreseña', 'md5');

        if ($this->form_validation->run() == FALSE) {
            //Se muestra el formulario con los mensajes de error.
        } else {
            //Chequemos los datos ingresados en la db
            $user = $this->UsersModel->verifyLogin($_POST['email'], $_POST['password']);

            //Si el usuario existe en la db..
            if (!empty($user)) {

                //..lo guardamos en sesion
                $this->session->set_userdata('usuario', $user);

                //Ahora, comprobamos si existio alguna pagina a donde se quiso entrar
                /* if ($this->session->userdata('lastPageVisited')) {
                  redirect($this->session->userdata('lastPageVisited'));
                  } else { */
                //y si no existe pagina lo enviamos al index de cliente
                redirect('cliente');
                //}
            } else {
                // Si no existe el usuario envio el mensaje de error.
                $data['error'] = 1;
            }
        }
        $data['title'] = 'Menu Virtual - Autenticar';
        $data['viewToLoad'] = 'user/login';
        $this->load->view('comunes/main', $data);
    }

    /**
     *  Cerrar session del usuario.
     */
    function close() {
        $this->session->sess_destroy();
        redirect('main');
    }

    /**
     * Formulario para registrar un usuario nuevo. 
     */
    function register() {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->form_validation->set_rules('name', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('phone', 'Teléfono', 'trim|required');
        //$this->form_validation->set_rules('username', 'Usuario', 'trim|required|callback__username_check');
        $this->form_validation->set_rules('email', 'Correo', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Contreseña', 'required|min_length[2]|max_length[12]|md5');
        $this->form_validation->set_rules('re_password', 'Confirmar contraseña', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            //$this->register();
            //Se muestra el formulario con los mensajes de error.
        } else {
            $fields = array(
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                //'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
                    //$activation_code = md5(microtime());
            );
            $insert = $this->UsersModel->insertRecord($fields);
            redirect('autenticar');
        }
        $data['title'] = 'Menu Virtual - Registrar';
        $data['viewToLoad'] = 'user/register';
        $this->load->view('comunes/main', $data);
    }

    /**
     * Valida si el usuario está registrado en la bd. 
     */
    function _checkUser($username) {
        return $this->UsersModel->checkUser($username);
    }

    /**
     * Valida si el correo está registrado en la bd. 
     */
    function _checkEmail($email) {
        return $this->UsersModel->checkEmail($email);
    }

    /**
     * Recordar al usuario su contraseña.
     */
    function rememberPassword() {
        /*
          $data['title'] = 'Menu Virtual - Recordar contraseña';
          $data['viewToLoad'] = 'user/rememberPassword';
          $this->load->view('comunes/main', $data);
         * 
         */
    }

    /**
     * Cambiar contraseña del usuario. 
     */
    function changePassword() {
        /*
          $data['title'] = 'Menu Virtual - Cambiar contraseña';
          $data['viewToLoad'] = 'user/changePassword';
          $this->load->view('comunes/main', $data);
         * 
         */
    }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
