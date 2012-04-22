<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of MenuOfTheDayController
 *
 * @author Carlos Bello
 */
class MenuOfTheDayController extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('MenusOfTheDayModel');
    }
    
    public function index() { 
        $data = array (
            'title' => 'Menu Virtual - Menú del día',
            'viewToLoad' => 'menu/types/menuOfTheDay',
            'menuType' => $this->MenusOfTheDayModel->getMenuTypeInfo(),
            'sections' => $this->MenusOfTheDayModel->getMenuSections()
        );
        $this->load->view('comunes/main', $data);
    }
}

/* End of file MenuOfTheDayController.php */
/* Location: ./application/controllers/MenuOfTheDayController.php */
