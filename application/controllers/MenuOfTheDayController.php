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
        $data = array(
            'title' => 'Menu Virtual - Menú del día',
            'viewToLoad' => 'menu/types/menuOfTheDay',
            'menuTypes' => $this->MenusOfTheDayModel->getMenuTypesInfo(),
            'sections' => $this->MenusOfTheDayModel->getSections(1),
        );
        $this->load->view('comunes/mainManager', $data);
    }

    public function getProducts() {
        echo json_encode($this->MenusOfTheDayModel->getProductsLike($_GET["term"], "id, name AS label, base_price"));
    }
    
    public function getMenusForDate($date) {
        $menus = $this->MenusOfTheDayModel->getMenusForDate($date);
        $content = count($menus) > 0
                ? $this->MenusOfTheDayModel->getMenuContent($menus[0]["id"])
                : array();
        echo json_encode(array("date" => $date, "menus" => $menus, "firstMenuContent" => $content));
    }
    
    public function getMenuContent($id) {
        echo json_encode($this->MenusOfTheDayModel->getMenuContent($id));
    }
    
    public function saveMenuForDate($date) {
        $menu = $this->input->post("menu");
        $this->MenusOfTheDayModel->setMenuForDate($date, $menu);
        echo json_encode($menu);
    }
    
}

/* End of file MenuOfTheDayController.php */
/* Location: ./application/controllers/MenuOfTheDayController.php */
