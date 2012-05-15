<?php
require_once 'MenuModel.php';
/**
 * Description of MenusOfTheDayModel
 *
 * @author carlos
 */
class MenusOfTheDayModel extends MenuModel {
    var $menuTypesId = array(1, 2);     // TODO: Leer desde la tabla en la BBDD
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getMenuTypesInfo() {
        $menuTypesInfo = array();
        foreach ($this->menuTypesId as $menuTypeId) {
            $menuTypesInfo[] = $this->getMenuTypeInfo($menuTypeId);
        }
        return $menuTypesInfo;
    }
}

/* End of file MenusOfTheDayModel.php */
/* Location: ./application/controllers/MenusOfTheDayModel.php */
