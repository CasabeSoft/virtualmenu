<?php

if (!function_exists('esta_autenticado')) {

    function esta_autenticado() {

        $CI = &get_instance();

        if ($CI->session->userdata('usuario')->usuario_id && $CI->session->userdata('usuario')->usuario_id !== '') {
            unset($CI);

            return true;
        }

        return false;
    }

}


?>
