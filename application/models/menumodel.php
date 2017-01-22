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
    }
    
    public function getMenuTypeInfo($menuType) {
        $query = $this->db
                ->where("id", $menuType)
                ->get('menu_types');
        return $query->row();
    }
    
    public function getSectionsForMenuType($menuType) {
        $query = $this->db
                ->select("id, name, order, id_section_type AS id_type")
                ->where("id_menu_type", $menuType)
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
        // TODO: Recuperar solo los menús del proveedor actual.
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
        $this->db->trans_start();
        try {
            $menuData = array(
                "id_type" => $menu["id_type"],
                "name" => $menu["name"],
                "start_date" => $date,
                "end_date" => $date, 
                "base_price" => $menu["base_price"],
                "id_provider" => $menu["id_provider"],
            );
            if ($menu["id"] == 0) {   // Es un menú nuevo: adicionar
                $this->db->insert("menus", $menuData);
                $menu["id"] = $this->db->query("SELECT LAST_INSERT_ID() AS id;")->row()->id;
            } else {                // El menú existe: actualizar
                $this->db->where("id", $menu["id"])
                        ->update("menus", $menuData);
            }
            $menuContent = array();
            foreach ($menu["sections"] as $section) {
                if (array_key_exists("products", $section))
                    foreach ($section["products"] as $product) {
                        $menuContent[] = array(
                            "id_menu" => $menu["id"],
                            "id_product" => $product["id"],
                            "order" => $product["order"],
                            "price" => $product["price"],
                            "id_section" => $section["id"]
                        );
                    }                
            }
            $this->db->from("products_by_menu")->where("id_menu", $menu["id"])->delete();
            $this->db->insert_batch("products_by_menu", $menuContent);
        } catch (Exception $ex) { 
            // TODO: tratar el error
        }
        $this->db->trans_complete();
        return $this->db->trans_status()
                ? $menu["id"]
                : 0;
    }
    
    public function removeMenu($id) {
        $this->db->from("menus")
                ->where("id", $id)
                ->delete();
    }
}

?>
