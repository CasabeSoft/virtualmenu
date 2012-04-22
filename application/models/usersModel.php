<?php

/**
 * Description of usersModel
 *
 * @author carlos
 */
class UsersModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Obtener todos los usuarios.
     * 
     * @author carlos
     * @author Leonardo
     * @return array 
     */
    public function get_users() {
        $query = $this->db->get(USERS);
        return $query->result_array();
    }

    /**
     * Obtener un usuario segun sus datos de autenticacion.
     * 
     * @author Leonardo
     * @param $email (Correo del usuario)
     * @param $password (Contraseña del usuario)
     * @return array  
     */
    public function verifyLogin($email, $password) {
        $user = $this->db->select('email, name, phone')
                ->where('email', $email)
                ->where('password', $password)
                ->get(USERS)
                ->row();

        return $user;
    }

    /**
     * Insertar un registro en la tabla.
     *  
     * @author Leonardo
     * @param $fields (Arreglo con los campos a insertar)
     * @return int (Id del registro insertado)  
     */
    function insertRecord($fields) {
        $this->db->insert(USERS, $fields);

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
        $this->db->update(USERS, $fields, $where);

        return $this->db->affected_rows();
    }

    function deleteRecord($id) {
        $this->db->delete(USERS, array('id' => $id));

        return;
    }
    
    function checkUser($username) {
        $this->db->where('username', $username);
        $query = $this->db->get(USERS);
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    function checkEmail($email) {
        $this->db->where('email', $email);
        $query = $this->db->get(USERS);
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    /*
      public function set_news() {
      $this->load->helper('url');

      $slug = url_title($this->input->post('title'), 'dash', TRUE);

      $data = array(
      'title' => $this->input->post('title'),
      'slug' => $slug,
      'text' => $this->input->post('text')
      );

      return $this->db->insert('news', $data);
      }
     */
}

?>
