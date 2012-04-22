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
    
    public function getMenuTypeInfo() {
        return array(
            "name" => "Consultar en BBD",
            "description" => "Descripción del menú del día"
        );
    }
    
    public function getMenuSections() {
        return array(
            array(
                "name" => "Primeros",
                "type" => 1,
            ),
            array(
                "name" => "Segundos",
                "type" => 1,
            ),
            array(
                "name" => "Postres",
                "type" => 2,
            ),
            array(
                "name" => "Extras",
                "type" => 2,
            )
        );
    }
}

?>
