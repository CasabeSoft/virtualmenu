<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuModel
 *
 * @author carlos
 */
class MenuModel extends CI_Model {
   
    public function __construct() {
        parent::__construct();
        //$this->load->database();
    }
    
    public function getMenuTypeInfo($menuType) {
        $query = $this->db
                ->where("id", $menuType)
                ->get('menu_types');
        return $query->row();
    }
    
    public function getSections($menuType) {
        $query = $this->db
                ->where("id_menu_type = " . $menuType)
                ->order_by("order", "asc")
                ->get("sections");
        return $query->result_array();
    }
    
    public function getProductsLike($like, $fields) {
        $query = $this->db
                ->select($fields)
                ->like('name', $like)
                ->order_by("name", "asc")
                ->get("products");
        return $query->result_array();
    }
    
    public function getMenusForDate($date) {
        $query = $this->db->query("SELECT menus.*, description FROM menus INNER JOIN menu_types ON menus.id_type = menu_types.id WHERE '".$date."' BETWEEN start_date AND end_date");   // TODO: pasar a ActiveRecorsd
        return $query->result_array();
    }
    
    public function getMenuContent($menuId) {
        $query = $this->db
                ->select("products_by_menu.*, products.name")
                ->from("products_by_menu")
                ->join("products", "products_by_menu.id_product = products.id")
                ->where("id_menu", $menuId)
                ->order_by("id_section", "asc")
                ->order_by("`order`", "asc")
                ->get();
        return $query->result_array();
    }
    
    public function setMenuForDate($date, $menu) {
        if ($menu->id == 0) { // Es un menú nuevo: adicionar
            $this->db->insert("menus", array(
                "id_type" => $menu->id_type
                ));
        }
    }
}

?>
