<?php

/**
 * Controlador de Grupos
 *
 * @author Leonardo
 */
class GroupsModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Obtener todos los registros.
     * 
     * @author Leonardo
     * @return array 
     */
    public function getAll() {
        $query = $this->db
                ->select("id as value, name as label")
                ->get(GROUPS);
        return $query->result_array();
    }

    /**
     * Obtener un registro a partir del id.
     * 
     * @author Leonardo
     * @return array 
     */
    public function getById($id) {
        $query = $this->db->limit(1)
                ->get_where(GROUPS, array('id' => $id));
        return $query->row();
    }

    /**
     * Insertar un registro en la tabla.
     *  
     * @author Leonardo
     * @param $fields (Arreglo con los campos a insertar)
     * @return int (Id del registro insertado)  
     */
    function insertRecord($fields) {
        $this->db->insert(GROUPS, $fields);

        return $this->db->insert_id();
    }

    /**
     * Actualiza un registro en la tabla.
     * 
     * @author Leonardo
     * @param $fields (Arreglo con los campos y valores a modificar)
     * @param $where (Filtro de los campos a modificar)
     * @return int (Id del registro insertado)  
     */
    function updateRecord($fields, $where) {
        $this->db->update(GROUPS, $fields, $where);

        return $this->db->affected_rows();
    }

    /**
     * Borra un registro en la tabla.
     * 
     * @author Leonardo
     * @param $id (Campo id de la tabla)
     */
    function deleteRecord($id) {
        $this->db->delete(GROUPS, array('id' => $id));

        return;
    }

}

?>
