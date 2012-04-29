<?php

/*
 * Cabecera de la plantilla para el Administrador.
 * 
 * @author Leoanrdo Quintero
 */
?>
           
                <h1>Cabecera para el administrador</h1>
                <br>
                <a href="<?php echo site_url('/') ?>">Inicio</a> | 
                <a href="<?php echo site_url('administrator') ?>">Inicio Administrador</a> |
                <a href="<?php echo site_url('manager') ?>">Inicio Gestor</a> |
                <a href="<?php echo site_url('customer') ?>">Inicio Cliente</a>
                <br>
                <a href="<?php echo site_url('administrator/users1') ?>">Prueba CRUD</a> |
                <a href="<?php echo site_url('administrator/users') ?>">Usuarios</a> |               
                <a href="<?php echo site_url('administrator/group_types') ?>">Tipos de grupos</a> |
                <a href="<?php echo site_url('administrator/groups') ?>">Grupos</a> |
                <a href="<?php echo site_url('administrator/customers') ?>">Clientes</a> |
                <a href="<?php echo site_url('administrator/managers') ?>">Gestores</a> |
                <a href="<?php echo site_url('administrator/providers') ?>">Proveedores</a> |
                <a href="<?php echo site_url('administrator/products') ?>">Productos</a> |
                <a href="<?php echo site_url('administrator/section_types') ?>">Tipos de sección</a> |
                <a href="<?php echo site_url('administrator/sections') ?>">Secciones</a> |
                <a href="<?php echo site_url('administrator/menu_types') ?>">Tipos de menú</a> |
                <a href="<?php echo site_url('administrator/menus') ?>">Menus</a> |
                <a href="<?php echo site_url('exit') ?>">Salir</a>       
