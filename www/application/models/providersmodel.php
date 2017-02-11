<?php

/**
 * Controlador de proveedores
 *
 * @author Leonardo
*/
class ProvidersModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Obtener todos los registros.
     *
     * @return array
     */
    public function getAll() {
        $query = $this->db->get(PROVIDERS);
        return $query->result_array();
    }

    /**
     * Obtener un registro a partir del id.
     *
     * @return array
     */
    public function getById($id) {
        $query = $this->db->limit(1)
                ->get_where(PROVIDERS, array('id' => $id));
        return $query->row();
    }

    /**
     * Obtener un registro a partir del nombre de la url.
     *
     * @param $nameUri
     * @return int
     */
    public function getByUriName($nameUri) {
        $query = $this->db->limit(1)
                ->get_where(PROVIDERS, array('name_uri' => $nameUri))
                ->row();

        return $query;
        /*
          if ($query->num_rows() > 0)
          return $query->row()->id;

          return false; */
    }

    /**
     * Valida si es un proveedor.
     *
     * @param $nameUri
     * @return array
     */
    public function isProvider($nameUri) {
        $query = $this->db->select('id')
                ->get_where(PROVIDERS, array('name_uri' => $nameUri));

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
        $this->db->insert(PROVIDERS, $fields);

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
        $this->db->update(PROVIDERS, $fields, $where);

        return $this->db->affected_rows();
    }

    /**
     * Borra un registro en la tabla.
     *
     * @author Leonardo
     * @param $id (Campo id de la tabla)
     */
    public function deleteRecord($id) {
        $this->db->delete(PROVIDERS, array('id' => $id));

        return;
    }
}
