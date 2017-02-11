<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Controlador para los informes del gestor.
 *
 * @author Leoanrdo Quintero
 */
class Reports extends MY_Controller
{
    public function __construct() {
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
        $this->load->view('comunes/mainmanager', $data);
    }

    public function dayresume($date = '') {
        $this->load->model('OrdersModel');

        if (empty($date)) {
            $first_date = date("Y-m-d");
            $last_date = date("Y-m-d");
        } else {
            $first_date = $date;
            $last_date = $date;
        }
        $data['products'] = $this->OrdersModel->productOrderdByDate($this->providerId, $first_date, $last_date);
        $data['title'] = 'Menu Virtual - Reportes - Resumen del día';
        $data['viewToLoad'] = 'reports/index';
        $data['report'] = 'reports/dayresume';
        $this->load->view('comunes/mainmanager', $data);
    }

    public function weekresume() {
        $this->index();
    }

    public function monthresume() {
        $this->index();
    }

    public function daydetail($date = '') {
        $this->load->model('OrdersModel');

        if (empty($date)) {
            $first_date = date("Y-m-d");
            $last_date = date("Y-m-d");
        } else {
            $first_date = $date;
            $last_date = $date;
        }

        $data['details'] = $this->OrdersModel->detailsOfOrdersByDate($this->providerId, $first_date, $last_date);
        $data['title'] = 'Menu Virtual - Reportes - Detalles del día';
        $data['viewToLoad'] = 'reports/index';
        $data['report'] = 'reports/daydetail';
        $this->load->view('comunes/mainmanager', $data);
    }

    public function clients() {
        $this->index();
    }

    public function report($date = '', $format = '') {
        $this->load->library('PHPReport');

        $this->load->model('OrdersModel');

        if (empty($date)) {
            $first_date = date("Y-m-d");
            $last_date = date("Y-m-d");
        } else {
            $first_date = $date;
            $last_date = $date;
        }

        $datadb = $this->OrdersModel->productOrderdByDate($this->providerId, $first_date, $last_date);


        $R = new PHPReport();
        $R->load(array(
            'id' => 'Productos',
            'header' => array(
                'id_product' => 'Código', 'name' => 'Nombre', 'cuantity' => 'Cantidad'
            ),
            /*'footer' => array(
                'id_product' => '', 'name' => '', 'cuantity' => 10
            ),*/
            'config' => array(
                'header' => array(
                    'id_product' => array('width' => 80, 'align' => 'center'),
                    'name' => array('width' => 350, 'align' => 'left'),
                    'cuantity' => array('width' => 100, 'align' => 'right')
                ),
                'data' => array(
                    'id_product' => array('align' => 'center'),
                    'name' => array('align' => 'left'),
                    'cuantity' => array('align' => 'right')
                ),
                /*'footer' => array(
                    'cuantity' => array('align' => 'right')
                )*/
            ),
            'data' => $datadb
        ));

        //echo $R->render('excel');
        //exit();
        $data['title'] = 'Menu Virtual - Reportes - Detalles del día';
        $data['report'] = $R->render($format);
        $data['viewToLoad'] = 'reports/report';
        $this->load->view('comunes/mainmanager', $data);
    }
}

/* End of file report.php */
/* Location: ./application/controllers/manage/report.php */
