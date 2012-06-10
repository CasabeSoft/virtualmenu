<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controlador para el gestor.
 * 
 * @author Leoanrdo Quintero
 */
class ManagerController extends MY_Controller {

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
        redirect('menu/manage');
        exit();

        $data['title'] = 'Menu Virtual - Inicio Gestor';
        $data['viewToLoad'] = 'manager/home';
        $this->load->view('comunes/mainManager', $data);
    }

    public function products() {
        $this->load->library('grocery_CRUD');

        $crud = new grocery_CRUD();

        $crud->set_theme($this->config->item('grocery_crud_theme', 'virtualmenu'));
        $crud->set_table(PRODUCTS);
        $crud->columns('id', 'name', 'base_price');
        $crud->display_as('id', 'Código')
                ->display_as('name', 'Nombre')
                ->display_as('base_price', 'Precio Base');
        $crud->set_subject('Producto');
        $crud->fields('name', 'base_price', 'id_provider');
        $crud->change_field_type('id_provider', 'invisible');
        $crud->callback_before_insert(array($this, 'provider_callback'));
        $crud->required_fields('name');
        $data = $crud->render();

        $data->title = 'Menu Virtual - Productos';
        $data->titleMain = 'Productos';
        $data->viewToLoad = 'manager/main';
        $this->load->view('comunes/mainManager', $data);
    }

    function provider_callback($post_array) {
        $post_array['id_provider'] = $this->providerId;

        return $post_array;
    }

    function report1() {
        $this->load->library('PHPReport');

        $R = new PHPReport();
        $R->load(array(
            'id' => 'product',
            'data' => array(
                array('Some product', 23.99, 12),
                array('Other product', 5.25, 2.25),
                array('Third product', 0.20, 3.5)
            )
                )
        );

        echo $R->render();
        exit();
    }

    function report2() {
        $this->load->library('PHPReport');

        $R = new PHPReport();
        $R->load(array(
            'id' => 'product',
            'data' => array(
                array('Some product', 23.99, 12),
                array('Other product', 5.25, 2.25),
                array('Third product', 0.20, 3.5)
            ),
            'format' => array(
                1 => array('number' => array('prefix' => '$', 'decimals' => 2)),
                2 => array('number' => array('sufix' => ' EUR', 'decimals' => 1))
            )
                )
        );

        echo $R->render();
        exit();
    }

    function report3() {
        $this->load->library('PHPReport');

        $R = new PHPReport();
        $R->load(array(
            'id' => 'product',
            'header' => array(
                'Product name', 'Price', 'Tax'
            ),
            'footer' => array(
                '', 28.54, 17.89
            ),
            'data' => array(
                array('Some product', 23.99, 12),
                array('Other product', 5.25, 2.25),
                array('Third product', 0.20, 3.5)
            ),
            'format' => array(
                1 => array('number' => array('prefix' => '$', 'decimals' => 2)),
                2 => array('number' => array('sufix' => ' EUR', 'decimals' => 1))
            )
                )
        );

        echo $R->render('excel');
        exit();
    }

    function report4() {
        $this->load->library('PHPReport');

        $R = new PHPReport();
        $R->load(array(
            'id' => 'product',
            'header' => array(
                'Product name', 'Price', 'Tax'
            ),
            'footer' => array(
                '', 28.54, 17.89
            ),
            'config' => array(
                0 => array('width' => 120, 'align' => 'left'),
                1 => array('width' => 80, 'align' => 'right'),
                2 => array('width' => 80, 'align' => 'right')
            ),
            'data' => array(
                array('Some product', 23.99, 12),
                array('Other product', 5.25, 2.25),
                array('Third product', 0.20, 3.5)
            ),
            'format' => array(
                1 => array('number' => array('prefix' => '$', 'decimals' => 2)),
                2 => array('number' => array('sufix' => ' EUR', 'decimals' => 1))
            )
                )
        );

        echo $R->render('excel');
        exit();
    }

    function report5() {
        $this->load->library('PHPReport');

        $R = new PHPReport();
        $R->load(array(
            'id' => 'product',
            'header' => array(
                'product' => 'Product name', 'price' => 'Price', 'tax' => 'Tax'
            ),
            'footer' => array(
                'product' => '', 'price' => 28.54, 'tax' => 17.89
            ),
            'config' => array(
                'header' => array(
                    'product' => array('width' => 120, 'align' => 'center'),
                    'price' => array('width' => 80, 'align' => 'center'),
                    'tax' => array('width' => 80, 'align' => 'center')
                ),
                'data' => array(
                    'product' => array('align' => 'left'),
                    'price' => array('align' => 'right'),
                    'tax' => array('align' => 'right')
                ),
                'footer' => array(
                    'price' => array('align' => 'right'),
                    'tax' => array('align' => 'right')
                )
            ),
            'data' => array(
                array('product' => 'Some product', 'price' => 23.99, 'tax' => 12),
                array('product' => 'Other product', 'price' => 5.25, 'tax' => 2.25),
                array('product' => 'Third product', 'price' => 0.20, 'tax' => 3.5)
            ),
            'format' => array(
                'price' => array('number' => array('prefix' => '$', 'decimals' => 2)),
                'tax' => array('number' => array('sufix' => ' EUR', 'decimals' => 1))
            )
                )
        );

        echo $R->render();
        exit();
    }

    function report6() {
        $this->load->library('PHPReport');

        $R = new PHPReport();
        $R->load(array(
            'id' => 'product',
            'header' => array(
                'product' => 'Product name', 'price' => 'Price', 'tax' => 'Tax'
            ),
            'footer' => array(
                'product' => '', 'price' => 28.54, 'tax' => 17.89
            ),
            'config' => array(
                'header' => array(
                    'product' => array('width' => 120, 'align' => 'center'),
                    'price' => array('width' => 80, 'align' => 'center'),
                    'tax' => array('width' => 80, 'align' => 'center')
                ),
                'data' => array(
                    'product' => array('align' => 'left'),
                    'price' => array('align' => 'right'),
                    'tax' => array('align' => 'right')
                ),
                'footer' => array(
                    'price' => array('align' => 'right'),
                    'tax' => array('align' => 'right')
                )
            ),
            'data' => array(
                array('product' => 'Some product', 'price' => 23.99, 'tax' => 12),
                array('product' => 'Other product', 'price' => 5.25, 'tax' => 2.25),
                array('product' => 'Third product', 'price' => 0.20, 'tax' => 3.5)
            ),
            'group' => array(
                'caption' => array(
                    'Category 1', 'Another category'
                ),
                'rows' => array(
                    array(0),
                    array(1, 2)
                ),
                'summary' => array(
                    array('product' => '', 'price' => 23.99, 'tax' => 12),
                    array('product' => '', 'price' => 5.45, 'tax' => 5.75)
                )
            ),
            'format' => array(
                'price' => array('number' => array('prefix' => '$', 'decimals' => 2)),
                'tax' => array('number' => array('sufix' => ' EUR', 'decimals' => 1))
            )
                )
        );

        echo $R->render('xls');
        exit();
    }

    function report7() {
        $this->load->library('PHPReport');

        $R = new PHPReport();
        $R->load(array(
            array(
                'id' => 'product',
                'data' => array(
                    array('Some product', 23.99, 12),
                    array('Other product', 5.25, 2.25),
                    array('Third product', 0.20, 3.5)
                )
            ),
            array(
                'id' => 'product2',
                'data' => array(
                    array('value1', 'value2', 'value3', 'value4'),
                    array('value5', 'value6', 'value7', 'value8')
                )
            )
                )
        );

        echo $R->render('excel');
        exit();
    }

    function report8() {
        $this->load->library('PHPReport');

        //which template to use
        $template = 'invoice.xls';

        //set absolute path to directory with template files
        $templateDir = APPPATH . 'views/template/';

        //we get some products, e.g. from database
        $products = array(
            array('description' => 'Example product', 'qty' => 2, 'price' => 4.5, 'total' => 9),
            array('description' => 'Another product', 'qty' => 1, 'price' => 13.9, 'total' => 13.9),
            array('description' => 'Super product!', 'qty' => 3, 'price' => 1.5, 'total' => 4.5),
            array('description' => 'Yet another great product', 'qty' => 2, 'price' => 10.8, 'total' => 21.6),
            array('description' => 'Awesome', 'qty' => 1, 'price' => 19.9, 'total' => 19.9)
        );

        //set config for report
        $config = array(
            'template' => $template,
            'templateDir' => $templateDir
        );

        $R = new PHPReport($config);
        $R->load(array(
            array(
                'id' => 'inv',
                'data' => array('date' => date('Y-m-d'), 'number' => 312, 'customerid' => 12, 'orderid' => 517, 'company' => 'Example Inc.', 'address' => 'Some address', 'city' => 'Some City, 1122', 'phone' => '+111222333'),
                'format' => array(
                    'date' => array('datetime' => 'd/m/Y')
                )
            ),
            array(
                'id' => 'prod',
                'repeat' => true,
                'data' => $products,
                'minRows' => 2,
                'format' => array(
                    'price' => array('number' => array('prefix' => '$', 'decimals' => 2)),
                    'total' => array('number' => array('prefix' => '$', 'decimals' => 2))
                )
            ),
            array(
                'id' => 'total',
                'data' => array('price' => 68.9),
                'format' => array(
                    'price' => array('number' => array('prefix' => '$', 'decimals' => 2))
                )
            )
                )
        );
        //we can render html, excel, excel2003 or PDF
        echo $R->render('excel');

        exit();
    }

    function report9() {
        $this->load->library('PHPReport');

        //which template to use
        $template = 'stats.xls';

        //set absolute path to directory with template files
        $templateDir = APPPATH . 'views/template/';

        //we get some data, e.g. from database
        //function generates some random data
        function getData($n = 1, $cols = array('A'), $rows = 1, $c = array('Some country')) {
            //data is an array with 34 elements for each row!
            $data = array();
            for ($i = 1; $i <= $n; $i++) {
                $d['country'] = $c[$i - 1];
                foreach ($cols as $col) {
                    for ($r = 1; $r <= $rows; $r++) {
                        $d[$col . $r] = rand(0, 20);
                    }
                }
                $data[] = $d;
            }
            return $data;
        }

        $data = getData(3, array('A', 'B', 'C'), 11, array('Italy', 'Germany', 'France'));

        //set config for report
        $config = array(
            'template' => $template,
            'templateDir' => $templateDir
        );

        $R = new PHPReport($config);
        $R->load(array(
            'id' => 'v',
            'repeat' => true,
            'data' => $data,
                )
        );

        //we can set heading for report
        $R->setHeading('Report: Visitors in January');
        echo $R->render('html');

        exit();
    }

    function report10() {
        $this->load->library('PHPReport');
        $this->load->model('UsersModel');

        $data = $this->UsersModel->getAll();

        $R = new PHPReport();
        $R->load(array(
            'id' => 'user',
            'data' => $data
                )
        );

        echo $R->render();
        exit();
    }
    
    function report11($data1,$data2) {
        $this->load->library('PHPReport');

        $R = new PHPReport();
        $R->load(array(
            'id' => 'product',
            'data' => array(
                array('Some product', 23.99, $data1),
                array('Other product', 5.25, $data2),
                array('Third product', 0.20, 3.5)
            )
                )
        );

        echo $R->render();
        exit();
    }


}

/* End of file main.php */
/* Location: ./application/controllers/main.php */