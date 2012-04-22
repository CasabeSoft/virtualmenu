<?php

/**
 * Description of usersModel
 *
 * @author carlos
 */
class UsersModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        //$this->load->database();
    }

    public function get_users() {
        $query = $this->db->get('users');
        return $query->result_array();
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
