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
                <h2 class="span-7">Menú Virtual</h2> 
                <div class="span-13 last">
                    <div class="bar nav">
                        <div class="nav-outer">
                            <div class="nav-wrapper">
                                <div class="nav-inner">
                                    <ul class="hmenu">
                                        <li>
                                            <a href="<?php echo site_url('manager') ?>" <?php echo ($this->uri->segment(1) == "manager") ? 'class="active"' : '' ?>>Inicio Gestor</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('customer') ?>" <?php echo ($this->uri->segment(1) == "customer") ? 'class="active"' : '' ?>>Inicio Cliente</a>
                                        </li>


                                        <li>
                                            <a href="<?php echo site_url('administrator') ?>" <?php echo ($this->uri->segment(1) == "administrator") ? 'class="active"' : '' ?>>Catálogos</a>
                                            <ul>
                                                <li>
                                                    <a href="<?php echo site_url('administrator/users') ?>" <?php echo ($this->uri->segment(2) == "users") ? 'class="active"' : '' ?>>Usuarios</a>
                                                    <!--ul>
                                                        <li>
                                                            <a href="#">Menú Subitem 1.1</a>

                                                        </li>
                                                                        <li>
                                                            <a href="#">Menú Subitem 1.2</a>

                                                        </li>
                                                                        <li>
                                                            <a href="#">Menú Subitem 1.3</a>

                                                        </li>
                                                    </ul-->
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('administrator/group_types') ?>" <?php echo ($this->uri->segment(2) == "group_types") ? 'class="active"' : '' ?>>Tipos de grupos</a>

                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('administrator/groups') ?>" <?php echo ($this->uri->segment(2) == "groups") ? 'class="active"' : '' ?>>Grupos</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('administrator/customers') ?>" <?php echo ($this->uri->segment(2) == "customers") ? 'class="active"' : '' ?>>Clientes</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('administrator/managers') ?>" <?php echo ($this->uri->segment(2) == "managers") ? 'class="active"' : '' ?>>Gestores</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('administrator/providers') ?>" <?php echo ($this->uri->segment(2) == "providers") ? 'class="active"' : '' ?>>Proveedores</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('administrator/products') ?>" <?php echo ($this->uri->segment(2) == "products") ? 'class="active"' : '' ?>>Productos</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('administrator/section_types') ?>" <?php echo ($this->uri->segment(2) == "section_types") ? 'class="active"' : '' ?>>Tipos de sección</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('administrator/sections') ?>" <?php echo ($this->uri->segment(2) == "sections") ? 'class="active"' : '' ?>>Secciones</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('administrator/menu_types') ?>" <?php echo ($this->uri->segment(2) == "menu_types") ? 'class="active"' : '' ?>>Tipos de menú</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('administrator/menus') ?>" <?php echo ($this->uri->segment(2) == "menus") ? 'class="active"' : '' ?>>Menus</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('administrator') ?>" <?php echo ($this->uri->segment(1) == "#") ? 'class="active"' : '' ?>>Informes</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('exit') ?>" <?php echo ($this->uri->segment(1) == "exit") ? 'class="active"' : '' ?>>Salir</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
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
