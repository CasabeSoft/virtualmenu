<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of MenuOfTheDayController
 */
class MenuOfTheDayController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MenusOfTheDayModel');
        $this->load->model('BillModel');
        $this->grantAccessToRols(array(ROL_CUSTOMER, ROL_MANAGER));
    }

    public function index() {
        $this->manage();
    }

    public function manage() {
        $data = array(
            'title' => 'Menu Virtual > Menú del día > Gestión',
            'viewToLoad' => 'menu/types/menuofthedaymanage',
            'menuTypes' => $this->MenusOfTheDayModel->getMenuTypesInfo(),
            'sectionsByMenuType' => $this->MenusOfTheDayModel->getSectionsByMenuType(),
        );
        $this->load->view('comunes/mainmanager', $data);
    }

    public function order() {
        $data = array(
            'title' => 'Menu Virtual > Menú del día > Pedidos',
            'viewToLoad' => 'menu/types/menuOfTheDayOrder',
            'menuTypes' => $this->MenusOfTheDayModel->getMenuTypesInfo(),
            'address' =>$this->session->userdata("address"),
            'sectionsByMenuType' => $this->MenusOfTheDayModel->getSectionsByMenuType(),
        );
        $view = userHasPermition(ROL_MANAGER) ? 'comunes/mainmanager' : 'comunes/mainCustomer';
        $this->load->view($view, $data);
    }

    public function rol() {
        echo userHasPermition(ROL_MANAGER);
        echo $this->session->userdata('rol');
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
        $menu["id_provider"] = $this->session->userdata("providerId");
        $id = $this->MenusOfTheDayModel->setMenuForDate($date, $menu);
        echo json_encode($id);
    }

    public function removeMenu($id) {
        $this->MenusOfTheDayModel->removeMenu($id);
    }

    public function getMenusAndBillsForDate($date) {
        $menus = $this->MenusOfTheDayModel->getMenusForDate($date);
        $bills = $this->BillModel->getBillsForDate($date,
                $this->session->userdata("providerId"),
                $this->session->userdata("id"));
        echo json_encode(array(
            "date" => $date,
            "menus" => $menus,
            "bills" => $bills
        ));
    }

    public function confirmOrder() {
        $bill = $this->input->post("bill");
        $bill["id_user"] = $this->session->userdata("id");
        $bill["id_provider"] = $this->session->userdata("providerId");
        $id = $this->BillModel->setConfirmedOrder($bill);
        echo json_encode($id);
    }

    public function removeBill($id) {
        echo json_encode($this->BillModel->remove($id));
    }
}

/* End of file MenuOfTheDayController.php */
/* Location: ./application/controllers/MenuOfTheDayController.php */
