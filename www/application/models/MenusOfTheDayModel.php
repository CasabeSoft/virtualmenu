<?php
require_once 'MenuModel.php';
/**
 * Description of MenusOfTheDayModel
 */
class MenusOfTheDayModel extends MenuModel
{
    public function __construct() {
        parent::__construct();
    }

    public function getMenuTypesInfo($providerId) {
        $menuTypesInfo = array();
        $menuTypesId = array_values($this->getMenuTypesForProvider($providerId));
        foreach ($menuTypesId as $menuTypeId) {
            $menuTypesInfo[] = $this->getMenuTypeInfo($menuTypeId);
        }
        return $menuTypesInfo;
    }

    public function getSectionsByMenuType($providerId) {
        $sections = array();
        $menuTypesId = array_values($this->getMenuTypesForProvider($providerId));
        foreach ($menuTypesId as $menuTypeId) {
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
