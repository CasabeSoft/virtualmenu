<?php

/**
 * Description of usersModel
 */
class UsersModel extends CI_Model
{

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
        $query = $this->db->get(USERS);
        return $query->result_array();
    }

    /**
     * Obtener un registro a partir del id.
     *
     * @return object
     */
    public function getById($id) {
        $query = $this->db->limit(1)
                ->get_where(USERS, array('id' => $id));
        return $query->row();
    }

    /**
     * Obtener un registro a partir del Codigo.
     *
     * @param $code
     * @return object
     */
    public function getUserByCode($code) {
        $query = $this->db->limit(1)
                ->get_where(USERS, array('password_code' => $code));
        return $query->row();
    }

    /**
     * Obtener un registro a partir del email.
     *
     * @param $email
     * @return object
     */
    public function getUserByEmail($email) {
        $query = $this->db->limit(1)
                ->get_where(USERS, array('email' => $email));
        return $query->row();
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

        $result = $this->db->select('id, email, name, phone, address')  // CB 20120626: Adicionado 'address'
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
    public function isUserCustomer($user_id) {

        $query = $this->db->select_sum('id')
                ->where('id', $user_id)
                ->get(CUSTOMERS);

        if ($query->num_rows() > 0) {
            return ($query->row()->id != 0);
        }
        return false;
    }

    /**
     * Obtener si el usuario es un Gestor.
     *
     * @author Leonardo
     * @param $user_id (Id del usuario)
     * @return bool
     */
    public function isUserManager($user_id) {

        $query = $this->db->select_sum('id')
                ->where('id', $user_id)
                ->get(MANAGERS);

        if ($query->num_rows() > 0) {
            return ($query->row()->id != 0);
        }
        return false;
    }

    /**
     * Obtener si el usuario es un Administrador.
     *
     * @author Leonardo
     * @param $mail
     * @param $password
     * @return bool
     */
    public function isUserAdministrator($mail, $password) {

        return (EMAIL_ADMINISTRATOR === $mail) and (PASSWORD_ADMINISTRATOR === $password);
    }

    /**
     * Insertar un registro en la tabla.
     *
     * @author Leonardo
     * @param $fields (Arreglo con los campos a insertar)
     * @return int (Id del registro insertado)
     */
    public function insertRecord($fields) {
        $this->db->insert(USERS, $fields);

        return $this->db->insert_id();
    }

    /**
     * Obtener un usuario cliente segun su id.
     *
     * @author Leonardo
     * @param $id
     * @return
     */
    public function getUserCustomerById($id) {

        $result = $this->db->select(USERS . '.*, ' . CUSTOMERS . '.group')//,'. CUSTOMERS_BY_PROVIDER . '.since')
                ->from(USERS, CUSTOMERS) //, CUSTOMERS_BY_PROVIDER)
                ->join(CUSTOMERS, USERS . '.id = ' . CUSTOMERS . '.id', 'LEFT')
                //->join(CUSTOMERS_BY_PROVIDER, USERS . '.id = ' . CUSTOMERS_BY_PROVIDER . '.id_customer')
                ->where(USERS . '.id', $id)
                ->limit(1)
                ->get()
                ->row();
        return $result;
    }

    /**
     * Insertar un usuario cliente en la tabla.
     *
     * @author Leonardo
     * @param $fields (Arreglo con los campos a insertar)
     * @return int (Id del registro insertado)
     */
    public function insertUserCustomer($fields) {

        //$this->db->trans_off();
        $this->db->trans_start();

        try {
            $fieldsUser = array(
                'name' => $fields['name'],
                'phone' => $fields['phone'],
                'email' => $fields['email'],
                'password' => $fields['password'],
                'address' => $fields['address']
            );
            $this->db->insert(USERS, $fieldsUser);

            $idUser = $this->db->insert_id();

            $fieldsCustomer = array(
                'id' => $idUser,
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

        return $this->db->trans_status() ? $idUser : false;
    }

    /**
     * Actualizar un usuario cliente en la tabla.
     *
     * @author Leonardo
     * @param $fields (Arreglo con los campos a insertar)
     * @return bool
     */
    public function updateUserCustomer($fields, $where) {

        //$this->db->trans_off();
        $this->db->trans_start();

        try {
            $fieldsUser = array(
                'name' => $fields['name'],
                'phone' => $fields['phone'],
                'address' => $fields['address'],
                    //'email' => $fields['email'],
                    //'password' => $fields['password']
            );
            $this->db->update(USERS, $fieldsUser, $where);

            $fieldsCustomer = array(
                'group' => $fields['group']
            );

            $this->db->update(CUSTOMERS, $fieldsCustomer, $where);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
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
        $this->db->update(USERS, $fields, $where);

        return $this->db->affected_rows();
    }

    /**
     * Borra un registro en la tabla.
     *
     * @author Leonardo
     * @param $id (Campo id de la tabla)
     */
    public function deleteRecord($id) {
        $this->db->delete(USERS, array('id' => $id));

        return;
    }

    /**
     * Valida si el usuario existe.
     *
     * @author Leonardo
     * @param $username
     * @return bool  (Si existe retorna false )
     */
    public function checkUser($username) {
        $this->db->where('username', $username);
        $query = $this->db->get(USERS);
        return !($query->num_rows() > 0);
    }

    /**
     * Valida si el email existe.
     *
     * @author Leonardo
     * @param $email (Correo del usuario)
     * @return bool  (Si existe retorna false )
     */
    public function checkEmail($email) {
        $this->db->where('email', $email);
        $query = $this->db->get(USERS);
        return !($query->num_rows() > 0);
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
    public function changePassword($email, $oldPassword, $newPassword) {

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

        return false;
    }

    /**
     * Hashes de la contraseña que se almacena en la base de datos.
     *
     * @author Leonardo
     * @return string
     * */
    public function hashPassword($password, $salt = false) {
        if (empty($password)) {
            return false;
        }

        if ($salt) {
            return sha1($password . $salt);
        } else {
            $salt = $this->salt();
            return $salt . substr(sha1($salt . $password), 0, -10);
        }
    }

    /**
     * Genera un valor de salto aleatorio.
     *
     * @author Leonardo
     * @return string
     * */
    public function salt() {
        return substr(md5(uniqid(rand(), true)), 0, 10);
    }

    /**
     * Actualiza el codigo para recordar contraseña.
     *
     * @author Leonardo
     * @param $email
     * @return bool
     * */
    public function resetPassword($email = '') {
        if (empty($email)) {
            return false;
        }

        $code = $this->hashPassword(microtime() . $email);

        $this->db->update(USERS, array('password_code' => $code), array('email' => $email));

        if ($this->db->affected_rows() == 1) {
            return $code;
        }

        return false;
    }

    /**
     * Genera nueva contraseña para el usuario que la habia olvidado.
     *
     * @author Leonardo
     * @param $code
     * @param $salt
     * @return string
     * */
    public function resetPasswordComplete($code) {
        if (empty($code)) {
            return false;
        }

        $this->db->where('password_code', $code);

        if ($this->db->count_all_results(USERS) > 0) {
            $password = $this->salt();

            $hashPassword = md5($password);

            $data = array(
                'password' => $hashPassword,
                'password_code' => '0',
                'active' => 1,
            );

            $this->db->update(USERS, $data, array('password_code' => $code));

            if ($this->db->affected_rows() == 1) {
                return $password;
            }
        }

        return false;
    }
}
