<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controlador para el administrador.
 * 
 * @author Leoanrdo Quintero
 */
class AdministratorController extends MY_Controller {

    function __construct() {
        parent::__construct();
        if (!isLogged()) {
            redirect('login');
            exit;
        }
        if (!userHasPermition(ROL_ADMINISTRATOR)) {
            redirect('denied');
            exit;
        }
        $this->load->library('grocery_CRUD');
    }

    public function index() {

        $data->title = 'Menu Virtual - Inicio administrador';
        $data->viewToLoad = 'administrator/home';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    public function users1() {

        $this->grocery_crud->set_table(USERS);
        $data = $this->grocery_crud->render();

        $data->title = 'Menu Virtual - Usuarios';
        $data->titleMain = 'Usuarios';
        $data->viewToLoad = 'administrator/main';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    public function users() {

        $crud = new grocery_CRUD();

        //$crud->set_language("french"); 
        $crud->set_theme($this->config->item('grocery_crud_theme', 'virtualmenu'));
        $crud->set_table(USERS);
        $crud->set_subject('Usuario');
        $crud->columns('name', 'phone', 'email', 'address');
        $crud->display_as('name', 'Nombre')
                ->display_as('phone', 'Teléfono')
                ->display_as('email', 'Correo')
                ->display_as('address', 'Dirección')
                ->display_as('password', 'Contraseña');
        $crud->change_field_type('password', 'password');
        $crud->callback_before_insert(array($this, 'encrypt_password_callback'));
        $crud->add_fields('name', 'phone', 'email', 'password', 'address');
        $crud->edit_fields('name', 'phone', 'email', 'address');
        $crud->required_fields('name', 'email', 'password', 'address');
        $data = $crud->render();

        $data->title = 'Menu Virtual - Usuarios';
        $data->titleMain = 'Usuarios';
        $data->viewToLoad = 'administrator/main';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    function encrypt_password_callback($post_array) {
        $post_array['password'] = md5($post_array['password']);

        return $post_array;
    }

    public function groupTypes() {
        $crud = new grocery_CRUD();

        $crud->set_theme($this->config->item('grocery_crud_theme', 'virtualmenu'));
        $crud->set_table(GROUP_TYPES);
        $crud->columns('id', 'name', 'description');
        $crud->display_as('id', 'Código')
                ->display_as('name', 'Nombre')
                ->display_as('description', 'Descripción');
        $crud->set_subject('Tipo de Grupo');
        $crud->required_fields('name');
        $data = $crud->render();

        $data->title = 'Menu Virtual - Tipos de grupos';
        $data->titleMain = 'Tipos de grupos';
        $data->viewToLoad = 'administrator/main';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    public function groups() {
        $crud = new grocery_CRUD();

        $crud->set_theme($this->config->item('grocery_crud_theme', 'virtualmenu'));
        $crud->set_table(GROUPS);
        $crud->columns('id', 'name', 'address', 'id_type');
        $crud->display_as('id', 'Código')
                ->display_as('name', 'Nombre')
                ->display_as('address', 'Dirección')
                ->display_as('id_type', 'Tipo');
        $crud->set_subject('Grupo');
        $crud->set_relation('id_type', GROUP_TYPES, 'name');
        $crud->required_fields('name');
        $data = $crud->render();

        $data->title = 'Menu Virtual - Grupos';
        $data->titleMain = 'Grupos';
        $data->viewToLoad = 'administrator/main';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    public function customers() {
        $crud = new grocery_CRUD();

        $crud->set_theme($this->config->item('grocery_crud_theme', 'virtualmenu'));
        $crud->set_table(CUSTOMERS);
        $crud->columns('id', 'group', 'provider');
        $crud->display_as('id', 'Usuario')
                ->display_as('group', 'Grupo')
                ->display_as('provider', 'Proveedor');
        $crud->set_subject('Cliente');
        $crud->set_relation('id', USERS, 'name');
        $crud->set_relation('group', GROUPS, 'name');
        $crud->set_relation_n_n('provider', CUSTOMERS_BY_PROVIDER, PROVIDERS, 'id_customer', 'id_provider', 'name');
        $crud->required_fields('id', 'provider');
        $data = $crud->render();

        $data->title = 'Menu Virtual - Clientes';
        $data->titleMain = 'Clientes';
        $data->viewToLoad = 'administrator/main';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    public function managers() {
        $crud = new grocery_CRUD();

        $crud->set_theme($this->config->item('grocery_crud_theme', 'virtualmenu'));
        $crud->set_table(MANAGERS);
        $crud->columns('id', 'providers');
        $crud->display_as('id', 'Usuario')
                ->display_as('providers', 'Proveedor');
        $crud->set_subject('Gestor');
        $crud->set_relation('id', USERS, 'name');
        $crud->set_relation_n_n('providers', MANAGERS_BY_PROVIDER, PROVIDERS, 'id_manager', 'id_provider', 'name');
        $crud->required_fields('id', 'provider');
        $data = $crud->render();

        $data->title = 'Menu Virtual - Gestores';
        $data->titleMain = 'Gestores';
        $data->viewToLoad = 'administrator/main';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    public function providers() {
        $crud = new grocery_CRUD();

        $crud->set_theme($this->config->item('grocery_crud_theme', 'virtualmenu'));
        $crud->set_table(PROVIDERS);
        $crud->columns('id', 'name', 'email', 'address', 'phone', 'web', 'administrator');
        $crud->display_as('id', 'Código')
                ->display_as('name', 'Nombre')
                ->display_as('email', 'Correo')
                ->display_as('address', 'Dirección')
                ->display_as('phone', 'Teléfono')
                ->display_as('web', 'Web')
                ->display_as('administrator', 'Administrador');
        $crud->set_subject('Proveedor');
        $crud->set_relation('administrator', MANAGERS, 'id');
        $crud->required_fields('name', 'administrator');
        $data = $crud->render();

        $data->title = 'Menu Virtual - Proveedores';
        $data->titleMain = 'Proveedores';
        $data->viewToLoad = 'administrator/main';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    public function products() {
        $crud = new grocery_CRUD();

        $crud->set_theme($this->config->item('grocery_crud_theme', 'virtualmenu'));
        $crud->set_table(PRODUCTS);
        $crud->columns('id', 'name', 'base_price', 'id_provider');
        $crud->display_as('id', 'Código')
                ->display_as('name', 'Nombre')
                ->display_as('base_price', 'Precio Base')
                ->display_as('id_provider', 'Proveedor');
        $crud->set_subject('Producto');
        $crud->set_relation('id_provider', PROVIDERS, 'name');
        //$crud->set_relation_n_n('menu', PRODUCTS_BY_MENU, MENUS, 'id_product', 'id_menu', 'name');
        $crud->required_fields('name', 'id_provider');
        $data = $crud->render();

        $data->title = 'Menu Virtual - Productos';
        $data->titleMain = 'Productos';
        $data->viewToLoad = 'administrator/main';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    public function menus() {
        $crud = new grocery_CRUD();

        $crud->set_theme($this->config->item('grocery_crud_theme', 'virtualmenu'));
        $crud->set_table(MENUS);
        $crud->columns('id', 'id_type', 'name', 'start_date', 'end_date', 'base_price', 'id_provider');
        $crud->display_as('id', 'Código')
                ->display_as('id_type', 'Tipo')
                ->display_as('name', 'Nombre')
                ->display_as('start_date', 'Fecha Inicial')
                ->display_as('end_date', 'Fecha Final')
                ->display_as('base_price', 'Precio Base')
                ->display_as('id_provider', 'Proveedor');
        $crud->set_subject('Menú');
        $crud->set_relation('id_type', MENU_TYPES, 'name');
        $crud->set_relation('id_provider', PROVIDERS, 'name');
        $crud->required_fields('id_type', 'name', 'base_price', 'id_provider');
        $data = $crud->render();

        $data->title = 'Menu Virtual - Menus';
        $data->titleMain = 'Menus';
        $data->viewToLoad = 'administrator/main';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    public function menuTypes() {
        $crud = new grocery_CRUD();

        $crud->set_theme($this->config->item('grocery_crud_theme', 'virtualmenu'));
        $crud->set_table(MENU_TYPES);
        $crud->columns('id', 'name', 'description', 'provider');
        $crud->display_as('id', 'Código')
                ->display_as('name', 'Nombre')
                ->display_as('description', 'Descripción')
                ->display_as('provider', 'Proveedor');
        $crud->set_subject('Tipo de Menú');
        $crud->set_relation_n_n('provider', MENU_TYPES_BY_PROVIDER, PROVIDERS, 'id_type', 'id_provider', 'name');
        $crud->required_fields('name', 'provider');
        $data = $crud->render();

        $data->title = 'Menu Virtual - Tipos de Menú';
        $data->titleMain = 'Tipos de Menú';
        $data->viewToLoad = 'administrator/main';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    public function sections() {
        $crud = new grocery_CRUD();

        $crud->set_theme($this->config->item('grocery_crud_theme', 'virtualmenu'));
        $crud->set_table(SECTIONS);
        $crud->columns('id', 'name', 'order', 'id_section_type', 'id_menu_type');
        $crud->display_as('id', 'Código')
                ->display_as('name', 'Nombre')
                ->display_as('order', 'Orden')
                ->display_as('id_section_type', 'Tipo')
                ->display_as('id_menu_type', 'Tipo de Menú');
        $crud->set_subject('Sección');
        $crud->set_relation('id_section_type', SECTION_TYPES, 'name');
        $crud->set_relation('id_menu_type', MENU_TYPES, 'name');
        $crud->required_fields('name', 'id_section_type', 'id_menu_type');
        $data = $crud->render();

        $data->title = 'Menu Virtual - Secciones';
        $data->titleMain = 'Secciones';
        $data->viewToLoad = 'administrator/main';
        $this->load->view('comunes/mainAdministrator', $data);
    }

    public function sectionTypes() {
        $crud = new grocery_CRUD();

        $crud->set_theme($this->config->item('grocery_crud_theme', 'virtualmenu'));
        $crud->set_table(SECTION_TYPES);
        $crud->columns('id', 'name', 'description');
        $crud->display_as('id', 'Código')
                ->display_as('name', 'Nombre')
                ->display_as('description', 'Descripción');
        $crud->set_subject('Tipo de Sección');
        $crud->required_fields('name');
        $data = $crud->render();

        $data->title = 'Menu Virtual - Tipos de Sección';
        $data->titleMain = 'Tipos de Sección';
        $data->viewToLoad = 'administrator/main';
        $this->load->view('comunes/mainAdministrator', $data);
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */