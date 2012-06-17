<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of MenuOfTheDayController
 *
 * @author Carlos Bello
 */
class MenuOfTheDayController extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('MenusOfTheDayModel');
    }

    public function index() {
        $this->manage();
    }
    
    public function manage() {
        $data = array(
            'title' => 'Menu Virtual > Menú del día > Gestión',
            'viewToLoad' => 'menu/types/menuOfTheDayManage',
            'menuTypes' => $this->MenusOfTheDayModel->getMenuTypesInfo(),
            'sectionsByMenuType' => $this->MenusOfTheDayModel->getSectionsByMenuType(),            
        );
        $this->load->view('comunes/mainManager', $data);
    }
    
    public function order() {
        $data = array(
            'title' => 'Menu Virtual > Menú del día > Pedidos',
            'viewToLoad' => 'menu/types/menuOfTheDayOrder',
            'menuTypes' => $this->MenusOfTheDayModel->getMenuTypesInfo(),
            'sectionsByMenuType' => $this->MenusOfTheDayModel->getSectionsByMenuType(),            
        );
        $this->load->view('comunes/mainCustomer', $data);
    }
    
    public function getSections() {
        echo json_encode($this->MenusOfTheDayModel->getSectionsByMenuType());
    }

    public function getProducts() {
        echo json_encode($this->MenusOfTheDayModel->getProductsLike($_GET["term"], "id, name AS label, base_price"));
    }
    
    public function getMenusForDate($date) {
        $menus = $this->MenusOfTheDayModel->getMenusForDate($date);
        echo json_encode(array("date" => $date, "menus" => $menus));
    }
    
    public function getMenuContent($id) {
        echo json_encode($this->MenusOfTheDayModel->getMenuContent($id));
    }
    
    public function saveMenuForDate($date) {
        $menu = $this->input->post("menu");
        $menu["id_provider"] =  $this->session->userdata("providerId");
        $id = $this->MenusOfTheDayModel->setMenuForDate($date, $menu);
        echo json_encode($id);
    }
    
    public function removeMenu($id) {
        $this->MenusOfTheDayModel->removeMenu($id);
    }
    
}

/* End of file MenuOfTheDayController.php */
/* Location: ./application/controllers/MenuOfTheDayController.php */
