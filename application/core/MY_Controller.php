<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Extendiendo la clase Controller para validar el proveedor.
 *
 */
class MY_Controller extends CI_Controller {

    public $providerId;
    public $providerName;
    public $providerWeb;
    public $providerUriName;
    public $providerError;
    public $theme;

    function __construct() {
        parent::__construct();
        $this->load->config('virtualmenu', TRUE);

        $this->load->model('ProvidersModel');

        $url = base_url();

        $this->providerUriName = substr($url, 7, strpos($url, '.') - 7);

        if ($this->providerUriName === DOMAIN_NAME) {
            $this->providerId = 0;
            $this->providerName = 'Sitio Principal';
            $this->providerWeb = 'http://virtualmenu.dev';
            $this->theme = $url . 'themes/default';
        } else {
            if (!empty($this->providerUriName)) {
                if ($this->ProvidersModel->isProvider($this->providerUriName)) {
                    $provider = $this->ProvidersModel->getByUriName($this->providerUriName);
                    $this->providerId = $provider->id;
                    $this->providerName = $provider->name;
                    $this->providerWeb = $provider->web;
                    $this->theme = $url . 'themes/' . $this->providerUriName;
                } else {
                    $this->providerError = 'Proveedor desconocido';
                    //show_404();
                }
            } else {
                $this->providerError = 'Sin Proveedor';
                //show_404();
            }
        }
    }

}

/* End of file MY_Controller.php */
/* Location: ./application/libraries/MY_Controller.php */