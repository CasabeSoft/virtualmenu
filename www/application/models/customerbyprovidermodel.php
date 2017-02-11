<?php

/**
 * Controlador de Clientes
 *
 * @author Leonardo
 */
class CustomerByProviderModel extends CI_Model {

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
        $query = $this->db->get(CUSTOMERS_BY_PROVIDER);
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
                ->get_where(CUSTOMERS_BY_PROVIDER, array('id' => $id))
                ->row();
        return $query;
    }

    /* SELECT *
      FROM `customers_by_provider` , `providers`
      WHERE `customers_by_provider`.`id_provider` = `providers`.`id`
      AND `customers_by_provider`.`id_customer` =20
      AND `providers`.`name` = 'banana'
      LIMIT 0 , 30 */

    /**
     * Obtener si el usuario es un cliente del proveedor
     *
     * @author Leonardo
     * @param $customerId
     * @param $providerName
     * @return bool
     */
    public function isCustomerOfProvider($customerId, $providerName) {

        $query = $this->db->from(CUSTOMERS_BY_PROVIDER, PROVIDERS)
                ->where(CUSTOMERS_BY_PROVIDER . '.id_provider', PROVIDERS . '.id')
                ->where(CUSTOMERS_BY_PROVIDER . '.id_customer', $customerId)
                ->where(PROVIDERS . '.name', $providerName)
                ->limit(1)
                ->get();

        return $query->num_rows() > 0;
    }

    /**
     * Insertar un registro en la tabla.
     *
     * @author Leonardo
     * @param $fields (Arreglo con los campos a insertar)
     * @return int (Id del registro insertado)
     */
    public function insertRecord($fields) {
        $this->db->insert(CUSTOMERS_BY_PROVIDER, $fields);

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
        $this->db->update(CUSTOMERS_BY_PROVIDER, $fields, $where);

        return $this->db->affected_rows();
    }

    /**
     * Borra un registro en la tabla.
     *
     * @author Leonardo
     * @param $id (Campo id de la tabla)
     */
    public function deleteRecord($id) {
        $this->db->delete(CUSTOMERS_BY_PROVIDERS, array('id' => $id));

        return;
    }
}

?>
