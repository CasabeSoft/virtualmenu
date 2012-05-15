<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controlador para la gestión de usuarios.
 * 
 * @author Leoanrdo Quintero
 */
class UserController extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('UsersModel');
        $this->load->model('CustomerModel');
        $this->load->model('CustomerByProviderModel');
        $this->load->model('GroupsModel');
        $this->load->model('ProvidersModel');
    }

    /**
     * Mostrar listado de usuarios.
     *
     * Nota: Funcionalidad futura, que un administrador gestione los usuarios.
     */
    public function index() {
        // Verifa si el usuario esta autenticado.
        if (!isLogged()) {
            redirect('login');
            exit;
        }
        if (!isAdministrator()) {
            redirect('denied');
            exit;
        }
        $data['title'] = 'Menu Virtual - Usuarios';
        $data['viewToLoad'] = 'user/user';
        $data['users'] = $this->UsersModel->get_users();
        $this->load->view('comunes/main', $data);
    }

    /**
     *  Formulario para validar el acceso de un usuario.
     */
    function login() {

        //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        //$this->form_validation->set_rules('username', 'Usuario', 'trim|required');
        $this->form_validation->set_rules('email', 'Correo', 'trim|required');
        $this->form_validation->set_rules('password', 'Contreseña', 'required|md5');

        if ($this->form_validation->run() == TRUE) {

            $email = $_POST['email'];
            $password = $_POST['password'];
            //Validamos si es un usuario Administrador
            $isAdmin = $this->UsersModel->IsUserAdministrator($email, $password);
            //Chequemos los datos ingresados en la db
            $result = $this->UsersModel->verifyLogin($email, $password);

            //Si el usuario es el administrador o existe en la db..
            if (!empty($result) || $isAdmin) {

                if ($isAdmin) {
                    $user = array(
                        'id' => 0,
                        'email' => $email,
                        'name' => 'Administrator',
                        'providerName' => $this->providerName,
                        'providerId' => $this->providerId,
                        'rol' => '1'
                    );
                } else {
                    $user = array(
                        'id' => $result->id,
                        'email' => $result->email,
                        'name' => $result->name,
                        'providerName' => $this->providerName,
                        'providerId' => $this->providerId
                    );

                    // Validamos si es un usuario Cliente o Gestor para asignar el rol
                    if ($this->UsersModel->IsUserCustomer($result->id)) {
                        $user['rol'] = '3';
                    } elseif ($this->UsersModel->IsUserManager($result->id)) {
                        $user['rol'] = '2';
                    }
                }

                //..lo guardamos en sesion
                $this->session->set_userdata($user);

                //Ahora, comprobamos si existio alguna pagina a donde se quiso entrar
                /* if ($this->session->userdata('lastPageVisited')) {
                  redirect($this->session->userdata('lastPageVisited'));
                  } else { */

                //Según el rol del usuario lo enviamos a su página index
                switch ($user['rol']) {
                    case 1:
                        redirect('administrator');
                        break;
                    case 2:
                        redirect('manager');
                        break;
                    case 3:
                        redirect('customer');
                        break;
                    default:
                        break;
                }
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
        redirect('home');
    }

    /**
     *  Mostrar al usuario página de acceso denegado.
     */
    function denied() {
        $data['title'] = 'Menu Virtual - Acceso denegado';
        $data['viewToLoad'] = 'user/denied';
        $this->load->view('comunes/main', $data);
    }

    /**
     * Formulario para registrar un usuario nuevo. 
     */
    function register() {

        $result = $this->GroupsModel->getAll();

        $data['groups'] = json_encode($result);

        //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->form_validation->set_rules('name', 'Nombre', 'trim|required');
        //$this->form_validation->set_rules('phone', 'Teléfono', 'trim|required');
        //$this->form_validation->set_rules('username', 'Usuario', 'trim|required|callback__checkUser');
        $this->form_validation->set_rules('email', 'Correo', 'trim|required|valid_email|callback__checkEmail');
        $this->form_validation->set_rules('password', 'Contreseña', 'required|min_length[2]|max_length[20]|md5');
        $this->form_validation->set_rules('re_password', 'Confirmar contraseña', 'required|matches[password]');

        $this->form_validation->set_message('_checkEmail', 'El %s ya existe.');

        if ($this->form_validation->run() == TRUE) {

            $fields = array(
                // Campos de la tabla USERS
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                // Campos del la tabla CUSTOMERS
                'address' => $this->input->post('address'),
                'group' => $this->input->post('group'),
                // Campos de la tabla CUSTOMERS_BY_PROVIDER
                'id_provider' => $this->providerId,
                'since' => date('Y-m-d')
            );

            $idUser = $this->UsersModel->insertUserCustomer($fields);

            /*
              $fields = array(
              'name' => $this->input->post('name'),
              'phone' => $this->input->post('phone'),
              //'username' => $this->input->post('username'),
              'email' => $this->input->post('email'),
              'password' => $this->input->post('password')
              //$activation_code = md5(microtime());
              );
              $idUser = $this->UsersModel->insertRecord($fields);
              $fieldsCustomer = array(
              'id' => $idUser,
              'address' => $this->input->post('address'),
              'group' => $this->input->post('group')
              );
              $idCustomer = $this->CustomerModel->insertRecord($fieldsCustomer);

              $fieldsCustomerProvider = array(
              'id_customer' => $idUser,
              'id_provider' => $this->providerId,
              'since' => date('Y-m-d')
              );
              $idCustomerProvider = $this->CustomerByProviderModel->insertRecord($fieldsCustomerProvider);
             */

            if ($idUser) {
                $user = array(
                    'id' => $idUser,
                    'email' => $this->input->post('email'),
                    'name' => $this->input->post('name'),
                    'providerName' => $this->providerName,
                    'providerId' => $this->providerId,
                    'rol' => '3'
                );

                //..lo guardamos en sesion
                $this->session->set_userdata($user);

                // Lo enviamos a la página del cliente.
                redirect('customer');
            } else {
                $data['error'] = 1;
            }
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

        //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->form_validation->set_rules('email', 'Correo', 'required');

        if ($this->form_validation->run() == TRUE) {

            //$email = $this->session->userdata('email');

            $change = $this->UsersModel->changePassword($email, $this->input->post('old_password'), $this->input->post('new_password'));

            if ($change) { //Si la contraseña fue cambiada
                $data['error'] = 2;
            } else {
                $data['error'] = 1;
            }
        }

        $data['title'] = 'Menu Virtual - Recordar contraseña';
        $data['viewToLoad'] = 'user/rememberPassword';
        $this->load->view('comunes/main', $data);
    }

    /**
     * Cambiar contraseña del usuario. 
     */
    function changePassword() {
        if (!isLogged()) {
            redirect('login');
            exit;
        }

        //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->form_validation->set_rules('old_password', 'Contreseña actual', 'required|min_length[2]|max_length[20]|md5');
        $this->form_validation->set_rules('new_password', 'Nueva contreseña', 'required|min_length[2]|max_length[20]|md5');
        $this->form_validation->set_rules('new_confirm', 'Confirmar nueva contraseña', 'required|matches[new_password]');

        if ($this->form_validation->run() == TRUE) {

            $email = $this->session->userdata('email');

            $change = $this->UsersModel->changePassword($email, $this->input->post('old_password'), $this->input->post('new_password'));

            if ($change) { //Si la contraseña fue cambiada
                $data['error'] = 2;
            } else {
                $data['error'] = 1;
            }
        }
        
        $rol = $this->session->userdata('rol');
        switch ($rol) {
            case 1:
                $template =  'comunes/mainAdministrator';
                break;
            case 2:
                $template =  'comunes/mainManager';
                break;
            case 3:
                $template =  'comunes/mainCustomer';
                break;
            default:
                $template =  'comunes/main';
                break;
        }

        $data['title'] = 'Menu Virtual - Cambiar contraseña';
        $data['viewToLoad'] = 'user/changePassword';
        $this->load->view($template, $data);
    }

    function profile() {
        
        $rol = $this->session->userdata('rol');
        switch ($rol) {
            case 1:
                $template =  'comunes/mainAdministrator';
                break;
            case 2:
                $template =  'comunes/mainManager';
                break;
            case 3:
                $template =  'comunes/mainCustomer';
                break;
            default:
                $template =  'comunes/main';
                break;
        }

        $data['title'] = 'Menu Virtual - Configurar cuenta';
        $data['viewToLoad'] = 'user/profile';
        $this->load->view($template, $data);
    }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
