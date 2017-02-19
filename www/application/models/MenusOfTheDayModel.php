<?php
require_once 'MenuModel.php';
/**
 * Description of MenusOfTheDayModel
 */
class MenusOfTheDayModel extends MenuModel
{
    private $menuTypesId = array(1, 2);     // TODO: Leer desde la tabla en la BBDD

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

    public function getSectionsByMenuType() {
        $sections = array();
        foreach ($this->menuTypesId as $menuTypeId) {
            $sections[$menuTypeId] = $this->getSectionsForMenuType($menuTypeId);
            for ($i = 0; $i < count($sections[$menuTypeId]); $i++) {
                $sections[$menuTypeId][$i]['products'] = array();
            }
        }
        return $sections;
    }
}

/* End of file MenusOfTheDayModel.php */
/* Location: ./application/models/MenusOfTheDayModel.php */
