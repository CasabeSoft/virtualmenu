<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Controlador para la gestión de usuarios.
 *
 * @author Leoanrdo Quintero
 */
class UserController extends MY_Controller
{
    public function __construct() {
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
        $data['users'] = $this->UsersModel->getAll();
        $this->load->view('comunes/main', $data);
    }

    /**
     *  Formulario para validar el acceso de un usuario.
     */
    public function login() {

        //$this->form_validation->set_rules('username', 'Usuario', 'trim|required');
        $this->form_validation->set_rules('email', 'Correo', 'trim|required');
        $this->form_validation->set_rules('password', 'Contreseña', 'required|md5');

        if ($this->form_validation->run()) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            //Validamos si es un usuario Administrador
            $isAdmin = $this->UsersModel->isUserAdministrator($email, $password);
            //Chequemos los datos ingresados en la db
            $result = $this->UsersModel->verifyLogin($email, $password);

            //Si el usuario es el administrador o existe en la db..
            if (!empty($result) || $isAdmin) {
                if ($isAdmin) {
                    $user = array(
                        'id' => 0,
                        'email' => $email,
                        'name' => 'Administrator',
                        'phone' => 'sn',
                        'providerName' => $this->providerName,
                        'providerId' => $this->providerId,
                        'rol' => '1'
                    );
                } else {
                    $user = array(
                        'id' => $result->id,
                        'email' => $result->email,
                        'name' => $result->name,
                        'phone' => $result->phone,
                        'providerName' => $this->providerName,
                        'providerId' => $this->providerId,
                        'address' => $result->address,
                    );

                    // Validamos si es un usuario Cliente o Gestor para asignar el rol
                    if ($this->UsersModel->isUserCustomer($result->id)) {
                        $user['rol'] = '3';
                    } elseif ($this->UsersModel->isUserManager($result->id)) {
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
                $data['error'] = 'Revise los campos por favor. El nombre de usuario o contraseña no son correctos.';
            }
        }
        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }
        $data['title'] = 'Menu Virtual - Autenticar';
        $data['viewToLoad'] = 'user/login';
        $this->load->view('comunes/main', $data);
    }

    /**
     *  Cerrar session del usuario.
     */
    public function close() {
        $this->session->sess_destroy();
        redirect('home');
    }

    /**
     *  Mostrar al usuario página de acceso denegado.
     */
    public function denied() {
        $data['title'] = 'Menu Virtual - Acceso denegado';
        $data['viewToLoad'] = 'user/denied';
        $this->load->view('comunes/main', $data);
    }

    /**
     * Formulario para registrar un usuario nuevo.
     */
    public function register() {

        $result = $this->GroupsModel->getAll();

        $data['groups'] = json_encode($result);

        $this->form_validation->set_rules('name', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('phone', 'Teléfono', 'trim');
        $this->form_validation->set_rules('address', 'Dirección', 'trim');
        $this->form_validation->set_rules('group', 'Grupo', 'trim');
        $this->form_validation->set_rules('groupName', 'Grupo', 'trim');
        //$this->form_validation->set_rules('username', 'Usuario', 'trim|required|callback__checkUser');
        $this->form_validation->set_rules('email', 'Correo', 'trim|required|valid_email|callback__checkEmail');
        $this->form_validation->set_rules('password', 'Contreseña', 'required|min_length[2]|max_length[20]|md5');
        $this->form_validation->set_rules('re_password', 'Confirmar contraseña', 'required|matches[password]');

        $this->form_validation->set_message('_checkEmail', 'El %s ya existe.');

        if ($this->form_validation->run()) {
            $fields = array(
                // Campos de la tabla USERS
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'address' => $this->input->post('address'),
                // Campos del la tabla CUSTOMERS
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
                $data['error'] = 'No se pudo crear la cuenta.';
            }
        }
        $data['title'] = 'Menu Virtual - Registrar';
        $data['viewToLoad'] = 'user/register';
        $this->load->view('comunes/main', $data);
    }

    /**
     * Valida si el usuario está registrado en la bd.
     */
    public function _checkUser($username) {
        return $this->UsersModel->checkUser($username);
    }

    /**
     * Valida si el correo está registrado en la bd.
     */
    public function _checkEmail($email) {
        return $this->UsersModel->checkEmail($email);
    }

    /**
     * Cambiar contraseña del usuario.
     */
    public function changePassword() {
        if (!isLogged()) {
            redirect('login');
            exit;
        }

        //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->form_validation->set_rules('old_password', 'Contreseña actual', 'required|min_length[2]|max_length[20]|md5');
        $this->form_validation->set_rules('new_password', 'Nueva contreseña', 'required|min_length[2]|max_length[20]|md5');
        $this->form_validation->set_rules('new_confirm', 'Confirmar nueva contraseña', 'required|matches[new_password]');

        if ($this->form_validation->run()) {
            $email = $this->session->userdata('email');

            $change = $this->UsersModel->changePassword($email, $this->input->post('old_password'), $this->input->post('new_password'));

            if ($change) { //Si la contraseña fue cambiada .
                $data['message'] = 'Contraseña modificada.';
            } else {
                $data['error'] = 'No se pudo cambiar la contraseña.';
            }
        }

        $rol = $this->session->userdata('rol');
        switch ($rol) {
            case 1:
                $template = 'comunes/mainadministrator';
                break;
            case 2:
                $template = 'comunes/mainmanager';
                break;
            case 3:
                $template = 'comunes/mainCustomer';
                break;
            default:
                $template = 'comunes/main';
                break;
        }

        $data['title'] = 'Menu Virtual - Cambiar contraseña';
        $data['viewToLoad'] = 'user/changePassword';
        $this->load->view($template, $data);
    }

    public function profile() {

        $id = $this->session->userdata('id');
        $rol = $this->session->userdata('rol');
        switch ($rol) {
            case 1:
                $template = 'comunes/mainadministrator';
                break;
            case 2:
                $template = 'comunes/mainmanager';
                break;
            case 3:
                $template = 'comunes/mainCustomer';
                $result = $this->GroupsModel->getAll();
                break;
            default:
                $template = 'comunes/main';
                break;
        }

        $this->form_validation->set_rules('name', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('phone', 'Teléfono', 'trim');
        if ($rol == ROL_CUSTOMER) {
            $this->form_validation->set_rules('address', 'Dirección', 'trim');
            $this->form_validation->set_rules('group', 'Grupo', 'trim');
            $this->form_validation->set_rules('groupName', 'Grupo', 'trim');
        }
        //$this->form_validation->set_rules('username', 'Usuario', 'trim|required|callback__checkUser');

        if ($this->form_validation->run()) {
            if ($rol == ROL_CUSTOMER) {
                $fields = array(
                    // Campos de la tabla USERS
                    'name' => $this->input->post('name'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    //'email' => $this->input->post('email'),
                    //'password' => $this->input->post('password'),
                    // Campos del la tabla CUSTOMERS
                    'group' => $this->input->post('group'),
                        // Campos de la tabla CUSTOMERS_BY_PROVIDER
                        //'id_provider' => $this->providerId,
                        //'since' => date('Y-m-d')
                );

                $change = $this->UsersModel->updateUserCustomer($fields, array('id' => $id));
            } else {
                $fields = array(
                    // Campos de la tabla USERS
                    'name' => $this->input->post('name'),
                    'phone' => $this->input->post('phone'),
                );

                $change = $this->UsersModel->updateRecord($fields, array('id' => $id));
            }

            if ($change) {
                $user = array(
                    'name' => $this->input->post('name')
                );

                //..lo guardamos en sesion
                $this->session->set_userdata($user);

                $data['message'] = 'Datos modificados.';
            } else {
                $data['error'] = 'No se pudo modificar los datos.';
            }
        }

        $user = $this->UsersModel->getUserCustomerById($id);
        if ($rol == ROL_CUSTOMER) {
            $group = $this->GroupsModel->getById($user->group);

            $data['groupName'] = $group->name;
            $data['groups'] = json_encode($result);
        } else {    // CB 20120615: Adicionado para evitar error en perfil de Manager
            $data['groupName'] = '';
            $data['groups'] = array();
        }
        $data['title'] = 'Menu Virtual - Configurar cuenta';
        $data['viewToLoad'] = 'user/profile';
        $data['user'] = $user;
        $this->load->view($template, $data);
    }

    /**
     * Para que el cliente envie correo para contactar con el gestor.
     */
    public function contact() {

        //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        //$this->form_validation->set_rules('email', 'Correo', 'required');
        $this->form_validation->set_rules('message', 'Mensaje', 'required');

        if ($this->form_validation->run()) {
            $this->load->library('email');

            $config = $this->config->item('email', 'virtualmenu');

            $this->email->clear();
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");

            $emailFrom = $this->session->userdata('email');
            $nameFrom = $this->session->userdata('name');
            $providerId = $this->providerId;
            $provider = $this->ProvidersModel->getById($providerId);
            $emailTo = $provider->email;
            $data = array(
                'userName' => $nameFrom,
                'userEmail' => $emailFrom,
                'userPhone' => $this->session->userdata('phone'),
                'userMessage' => $this->input->post('message')
            );
            $message = $this->load->view('email/contactToManeger', $data, true);
            //$message = $this->input->post('message');

            $this->email->from($emailFrom, $nameFrom);
            $this->email->to($emailTo);
            $this->email->subject('Formulario de contacto de Menu Virtual');
            $this->email->message($message);

            if ($this->email->send()) {
                $data['message'] = 'Se ha enviado el correo.';
            } else {
                $data['error'] = 'No se ha podido enviar el correo.';
            }

            //echo $this->email->print_debugger();
        }

        $data['title'] = 'Menu Virtual - Contactar';
        $data['viewToLoad'] = 'user/contact';
        $this->load->view('comunes/mainCustomer', $data);
    }

    /**
     * Recordar al usuario su contraseña.
     */
    public function rememberPassword() {

        $this->form_validation->set_rules('email', 'Correo', 'required');

        if ($this->form_validation->run()) {
            $emailTo = $this->input->post('email');

            $user = $this->UsersModel->getUserByEmail($emailTo);

            if (!is_object($user)) {
                //$this->set_error('password_change_unsuccessful');
                return false;
            }

            $newCode = $this->UsersModel->resetPassword($user->email);

            if ($newCode) {
                $this->load->library('email');

                $config = $this->config->item('email', 'virtualmenu');

                $providerId = $this->providerId;
                $provider = $this->ProvidersModel->getById($providerId);

                $data = array(
                    'userName' => $user->name,
                    'passwordCode' => $newCode
                );

                $message = $this->load->view('email/rememberPassword', $data, true);

                $this->email->clear();
                $this->email->initialize($config);
                $this->email->set_newline("\r\n");
                $this->email->from($provider->email, site_url());
                $this->email->to($emailTo);
                $this->email->subject(site_url() . ' - Restablecer contraseña');
                $this->email->message($message);

                if ($this->email->send()) {
                    $data['message'] = 'Se ha enviado un correo para restablecer su contraseña.';
                } else {
                    $data['error'] = 'No se ha podido enviar el correo.';
                }

                //echo $this->email->print_debugger();
            }
        }
        if ($this->session->flashdata('error')) {
            $data['error'] = $this->session->flashdata('error');
        }

        $data['title'] = 'Menu Virtual - Recordar contraseña';
        $data['viewToLoad'] = 'user/rememberPassword';
        $this->load->view('comunes/main', $data);
    }

    /**
     * Restablecer la contraseña del usuario.
     *
     * @author Leonardo
     * @param $code
     * @return void
     */
    public function resetPassword() {

        $code = $this->uri->segment(2);
        //echo 'code: ' . $code . $this->uri->segment(2);
        //exit();
        $reset = $this->resetPasswordComplete($code);

        if ($reset) {
            $this->session->set_flashdata('message', 'Nueva contraseña enviada a su cuenta de correo');
            redirect('login', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'No se ha podido crear la nueva contraseña.');
            redirect('rememberPassword', 'refresh');
        }
    }

    /**
     * Enviar correo con el codogo para restablecer la contraseña
     *
     * @author Leonardo
     * @param $code
     * @return void
     * */
    public function resetPasswordComplete($code) {

        $user = $this->UsersModel->getUserByCode($code);

        if (!is_object($user)) {
            return false;
        }

        $newPassword = $this->UsersModel->resetPasswordComplete($code);

        if ($newPassword) {
            $this->load->library('email');

            $providerId = $this->providerId;
            $provider = $this->ProvidersModel->getById($providerId);

            $data = array(
                'userName' => $user->name,
                'newPassword' => $newPassword
            );

            $message = $this->load->view('email/newPassword', $data, true);

            $config = $this->config->item('email', 'virtualmenu');

            $this->email->clear();
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from($provider->email, site_url());
            $this->email->to($user->email);
            $this->email->subject(site_url() . ' - Nueva contraseña');
            $this->email->message($message);

            //echo $this->email->print_debugger();

            return $this->email->send();
        }
        return false;
    }
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
