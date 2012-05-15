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
     * Obtener un usuario según sus datos de autenticación.
     * 
     * @author Leonardo
     * @param $email (Correo del usuario)
     * @param $password (Contraseña del usuario)
     * @return array  
     */
    public function verifyLogin($email, $password) {

        $result = $this->db->select('id, email, name, phone')
                ->where('email', $email)
                ->where('password', $password)
                ->limit(1)
                ->get(USERS)
                ->row();
        return $result;
    }

    /**
     * Obtener si el usuario es un Cliente.
     * 
     * @author Leonardo
     * @param $user_id (Id del usuario)
     * @return bool  
     */
    function IsUserCustomer($user_id) {

        $query = $this->db->select_sum('id')
                ->where('id', $user_id)
                ->get(CUSTOMERS);

        if ($query->num_rows() > 0)
            return ($query->row()->id != 0) ? TRUE : FALSE;
        return FALSE;
    }

    /**
     * Obtener si el usuario es un Gestor.
     * 
     * @author Leonardo
     * @param $user_id (Id del usuario)
     * @return bool  
     */
    function IsUserManager($user_id) {

        $query = $this->db->select_sum('id')
                ->where('id', $user_id)
                ->get(MANAGERS);

        if ($query->num_rows() > 0)
            return ($query->row()->id != 0) ? TRUE : FALSE;
        return FALSE;
    }

    /**
     * Obtener si el usuario es un Administrador.
     * 
     * @author Leonardo
     * @param $mail
     * @param $password
     * @return bool  
     */
    function IsUserAdministrator($mail, $password) {

        return (EMAIL_ADMINISTRATOR === $mail) and (PASSWORD_ADMINISTRATOR === $password) ? TRUE : FALSE;
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
     * Insertar un registro en la tabla.
     *  
     * @author Leonardo
     * @param $fields (Arreglo con los campos a insertar)
     * @return int (Id del registro insertado)  
     */
    function insertUserCustomer($fields) {

        //$this->db->trans_off();
        $this->db->trans_start();

        try {
            $fieldsUser = array(
                'name' => $fields['name'],
                'phone' => $fields['phone'],
                'email' => $fields['email'],
                'password' => $fields['password']
            );
            $this->db->insert(USERS, $fieldsUser);

            $idUser = $this->db->insert_id();

            $fieldsCustomer = array(
                'id' => $idUser,
                'address' => $fields['address'],
                'group' => $fields['group']
            );

            $this->db->insert(CUSTOMERS, $fieldsCustomer);

            $fieldsCustomerProvider = array(
                'id_customer' => $idUser,
                'id_provider' => $fields['id_provider'],
                'since' => $fields['since']
            );

            $this->db->insert(CUSTOMERS_BY_PROVIDER, $fieldsCustomerProvider);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return $idUser;
        }
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

    /**
     * Borra un registro en la tabla.
     * 
     * @author Leonardo
     * @param $id (Campo id de la tabla)
     */
    function deleteRecord($id) {
        $this->db->delete(USERS, array('id' => $id));

        return;
    }

    /**
     * Valida si el usuario existe.
     * 
     * @author Leonardo
     * @param $username 
     * @return bool  (Si existe retorna FALSE )
     */
    function checkUser($username) {
        $this->db->where('username', $username);
        $query = $this->db->get(USERS);
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Valida si el email existe.
     * 
     * @author Leonardo
     * @param $email (Correo del usuario)
     * @return bool  (Si existe retorna FALSE )
     */
    function checkEmail($email) {
        $this->db->where('email', $email);
        $query = $this->db->get(USERS);
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Cambia la contraseña del usuario.
     * 
     * @author Leonardo
     * @param $email
     * @param $oldPassword
     * @param $newPassword
     * @return bool
     */
    function changePassword($email, $oldPassword, $newPassword) {

        $query = $this->db->select('password')
                ->where('email', $email)
                ->limit(1)
                ->get(USERS);

        $result = $query->row();

        $db_password = $result->password;

        if ($db_password === $oldPassword) {

            $this->db->where('email', $email)
                    ->update(USERS, array('password' => $newPassword));

            return $this->db->affected_rows() == 1;
        }

        return FALSE;
    }

}

?>
