<?php

/**
 * User Helpers
 *
 * @author Leoanrdo Quintero
 */
// ------------------------------------------------------------------------

/**
 * isLogged
 *
 * Valida si un usuario está autenticado.
 *
 * @return  bool	true si autenticado, false si no.
 */
if (!function_exists('isLogged')) {

    function isLogged() {

        $CI = &get_instance();

        //if ($CI->session->userdata('usuario')->email && $CI->session->userdata('usuario')->email !== '') {
        if ($CI->session->userdata('email') && $CI->session->userdata('email') !== '') {
            unset($CI);

            return true;
        }

        return false;
    }

}

/**
 * isAdministrator
 *
 * Valida si es el usuario Administrador.
 *
 * @return  bool	true si es el administrador, false si no.
 */
if (!function_exists('isAdministrator')) {

    function isAdministrator() {

        $CI = &get_instance();

        if ($CI->session->userdata('rol') && $CI->session->userdata('rol') === '1') {
            unset($CI);

            return true;
        }

        return false;
    }

}

/**
 * isManager
 *
 * Valida si es el usuario Gestor.
 *
 * @return  bool	true si es el Gestor, false si no.
 */
if (!function_exists('isManager')) {

    function isManager() {

        $CI = &get_instance();

        if ($CI->session->userdata('rol') && $CI->session->userdata('rol') === '2') {
            unset($CI);

            return true;
        }

        return false;
    }

}

/**
 * isCustomer
 *
 * Valida si es el usuario Cliente.
 *
 * @return  bool	true si es el Cliente, false si no.
 */
if (!function_exists('isCustomer')) {

    function isCustomer() {

        $CI = &get_instance();

        if ($CI->session->userdata('rol') && $CI->session->userdata('rol') === '3') {
            unset($CI);

            return true;
        }

        return false;
    }

}

/**
 * userHasPermition
 *
 * Valida si es el usuario Cliente.
 *
 * @return  bool	true si es el Cliente, false si no.
 */
if (!function_exists('userHasPermition')) {

    function userHasPermition($permiso) {

        $CI = &get_instance();

        $permisos = array(
            array(1), //Solo puede acceder el Administrador
            array(1, 2), //Puede acceder el Administrador y Gestor
            array(1, 2, 3)  //Puede acceder el Administrador, Gestor y el Cliente
        );

        if ($CI->session->userdata('rol')) {
            $rol = $CI->session->userdata('rol');
            unset($CI);
            if (@in_array($rol, $permisos[$permiso - 1])) {
                return true;
            }
        }

        return false;
    }

}


if (!function_exists('optionsCombobox')) {

    function optionsCombobox($array, $selected, $fieldId, $fieldName) {

        $result = "";
        if (count($array) > 0) {
            foreach ($array as $value) {
                $optionSelected = $value[$fieldId] == $selected ? " selected" : "";
                $result .= "<option value='" . $value[$fieldId] . "' $optionSelected>" . $value[$fieldName] . "</option>\n";
            }
        }
        return $result;
    }

}

/**
 * provider
 *
 * Muestra el nombre del proveedor activo.
 *
 * @return string
 */
if (!function_exists('providerName')) {

    function providerName() {

        $CI = &get_instance();
        $providerName = '';

        if ($CI->session->userdata('providerName')) {
            $providerName = $CI->session->userdata('providerName');
        }

        return $providerName;
    }

}
