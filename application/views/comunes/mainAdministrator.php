<?php
/**
 * Plantilla principal para el Administrador de la Web.
 * 
 * @author Leonardo Quintero 
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <base href="<?php echo base_url(); ?>" />
        <!-- Framework CSS -->
        <link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
        <link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print">
        <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
        <!-- Import fancy-type plugin for the sample page. -->
        <link rel="stylesheet" href="css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">        
        <!-- End Framework CSS -->
        <link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" />
        <link rel="shortcut icon" href="<?php echo $this->theme ?>/images/favicon.ico" type="image/x-icon" />
        <?php
        if (isset($css_files)) {
            foreach ($css_files as $file):
                ?>
                <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
                <?php
            endforeach;
        }
        ?>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->theme ?>/css/provider.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <?php
        if (isset($js_files)) {
            foreach ($js_files as $file):
                ?>
                <script src="<?php echo $file; ?>"></script>
                <?php
            endforeach;
        }
        ?>
        <script type="text/javascript" src="js/virtualmenu.js"></script>
    </head>
    <body>
        <div class="container">
            <div id="header" class="clearfix">
                <div class="prepend-0_1 span-3">
                    <a href="<?php echo $this->providerWeb; ?>" target="_blank"><img alt="Logo" src="<?php echo $this->theme; ?>/images/logo.png" /></a>    
                </div>
                <h1 class="span-20 last"><?php echo $this->providerName; ?></h1> 
                <h2 class="span-5">Menú Virtual</h2> 
                <div class="span-15 last">
                    <ul class="dropdown">
                        <li><a href="<?php echo site_url('home') ?>">Inicio</a> </li> 
                        <li><a href="<?php echo site_url('administrator') ?>">Inicio Administrador</a> </li>
                        <li><a href="<?php echo site_url('manager') ?>">Inicio Gestor</a> </li>
                        <li><a href="<?php echo site_url('customer') ?>">Inicio Cliente</a> </li>
                        <li><a href="<?php echo site_url('exit') ?>">Salir</a> </li>
                        <li><a href="<?php echo site_url('administrator/users') ?>">Usuarios</a> </li>               
                        <li><a href="<?php echo site_url('administrator/group_types') ?>">Tipos de grupos</a> </li>
                        <li><a href="<?php echo site_url('administrator/groups') ?>">Grupos</a> </li>
                        <li><a href="<?php echo site_url('administrator/customers') ?>">Clientes</a> </li>
                        <li><a href="<?php echo site_url('administrator/managers') ?>">Gestores</a> </li>
                        <li><a href="<?php echo site_url('administrator/providers') ?>">Proveedores</a> </li>
                        <li><a href="<?php echo site_url('administrator/products') ?>">Productos</a> </li>
                        <li><a href="<?php echo site_url('administrator/section_types') ?>">Tipos de sección</a> </li>
                        <li><a href="<?php echo site_url('administrator/sections') ?>">Secciones</a> </li>
                        <li><a href="<?php echo site_url('administrator/menu_types') ?>">Tipos de menú</a> </li>
                        <li><a href="<?php echo site_url('administrator/menus') ?>">Menus</a></li>
                    </ul>
                </div>
            </div>
            <div id="content">
                <?php $this->load->view($viewToLoad) ?>
            </div>
            <hr class="space">
            <div id="footer" class="span-24 last">
                <p class="alt prepend-1 prepend-top">&copy;2012 Vertul Menu.</p>
            </div>
        </div>
    </body>
</html>
