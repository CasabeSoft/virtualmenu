<?php

/**
 * Controlador de Ordenes
 *
 * @author Leonardo
 */
class OrdersModel extends CI_Model {

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
                ->get(ORDERS);
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
                ->get_where(ORDERS, array('id' => $id));
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
        $this->db->insert(ORDERS, $fields);

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
        $this->db->update(ORDERS, $fields, $where);

        return $this->db->affected_rows();
    }

    /**
     * Borra un registro en la tabla.
     * 
     * @author Leonardo
     * @param $id (Campo id de la tabla)
     */
    function deleteRecord($id) {
        $this->db->delete(ORDERS, array('id' => $id));

        return;
    }

    /**
     * Obtener los productos ordenados por un rango de fechas.
     * 
     * @author Leonardo
     * @return array 
     */
    public function productOrderdByDate($id_provider, $first_date, $last_date) {
        $sql = "SELECT po.id_product, p.`name`, count(po.id_product) as cuantity ";
        $sql .= " FROM orders o INNER JOIN products_by_order po ON o.id = po.id_order ";
        $sql .= "   INNER JOIN products p ON po.id_product = p.id ";
        $sql .= " WHERE p.id_provider = $id_provider ";
        $sql .= "   AND date(o.delivery_date) BETWEEN '$first_date' AND '$last_date' ";
        $sql .= " GROUP BY po.id_menu, p.`name`; ";

        $query = $this->db->query($sql);

        return $query->result_array();
    }
    
    /**
     * Detalles de pedidos para un rango de fechas.
     * 
     * @author Leonardo
     * @return array 
     */
    public function detailsOfOrdersByDate($id_provider, $first_date, $last_date) {
        $sql = "SELECT o.id, o.id_user, u.`name` user_name, u.address, u.phone, ";
        $sql .= "   o.comments, o.payment, po.id_product, p.`name` product_name ";
        $sql .= " FROM orders o INNER JOIN users u ON o.id_user = u.id ";
        $sql .= "   INNER JOIN products_by_order po ON o.id = po.id_order ";
        $sql .= "   INNER JOIN products p ON po.id_product = p.id ";
        $sql .= " WHERE p.id_provider = $id_provider  ";
        $sql .= "   AND date(o.delivery_date) BETWEEN '$first_date' AND '$last_date' ";
        $sql .= " ORDER BY o.id, po.id_product ";


        $query = $this->db->query($sql);

        return $query->result_array();
        //cast(horae as date)
    }
    
}

?>