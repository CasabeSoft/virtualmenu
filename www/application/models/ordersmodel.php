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
    public function insertRecord($fields) {
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
    public function updateRecord($fields, $where) {
        $this->db->update(ORDERS, $fields, $where);

        return $this->db->affected_rows();
    }

    /**
     * Borra un registro en la tabla.
     *
     * @author Leonardo
     * @param $id (Campo id de la tabla)
     */
    public function deleteRecord($id) {
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

        $qProducts = <<<EOD
SELECT po.id_product, p.`name`, count(po.id_product) as cuantity
FROM products_by_order po INNER JOIN products p on po.id_product = p.id
    INNER JOIN orders o on po.id_order = o.id
    INNER JOIN menus m on o.id_menu = m.id
    INNER JOIN products_by_menu pm on o.id_menu = pm.id_menu and po.id_product = pm.id_product
    INNER JOIN bills b on o.id_bill = b.id
WHERE b.id_provider = $id_provider
    AND date(m.end_date) BETWEEN '$first_date' AND '$last_date' -- TODO: Cambiar a order.for_date
GROUP BY po.id_product, p.`name`;
EOD;
        $query = $this->db->query($qProducts);

        return $query->result_array();
    }

    /**
     * Detalles de pedidos para un rango de fechas.
     *
     * @author Leonardo
     * @return array
     */
    public function detailsOfOrdersByDate($id_provider, $first_date, $last_date) {
        $qProducts = <<<EOD
SELECT o.id id_order, o.comments order_comments, m.`name` menu_name, p.`name` product_name,
    u.`name` user_name, u.phone, u.address
FROM bills b INNER JOIN orders o ON b.id = o.id_bill
    INNER JOIN menus m ON o.id_menu = m.id
    INNER JOIN products_by_order po ON o.id = po.id_order
    INNER JOIN products p ON po.id_product = p.id
    INNER JOIN users u ON b.id_user = u.id
WHERE m.id_provider = $id_provider
    AND date(m.end_date) BETWEEN '$first_date' AND '$last_date' -- TODO: Cambiar a order.for_date;
ORDER BY id_order;
EOD;

        $query = $this->db->query($qProducts);

        return $query->result_array();
        //cast(horae as date)
    }
}
