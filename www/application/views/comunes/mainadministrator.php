<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <base href="<?php echo base_url(); ?>" />
        <!-- Framework CSS -->
        <!-- Bootstrap -->
        <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- End Framework CSS -->
        <link type="text/css" rel="stylesheet" href="node_modules/jquery-ui-dist/jquery-ui.css" />
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->theme ?>/css/provider.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="<?php echo $this->theme ?>/images/favicon.ico" type="image/x-icon" />
        <?php
        if (isset($css_files)) {
            foreach ($css_files as $file) {
                ?>
                <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
                <?php
            }
        }
        ?>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->theme ?>/css/provider.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <?php $this->load->view('comunes/brand') ?>
                <nav class="collapse navbar-collapse" id="main-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li <?php echo ($this->uri->segment(1) == "manager") ? 'class="active"' : '' ?>>
                            <a href="<?php echo site_url('manager') ?>">Inicio Gestor</a>
                        </li>
                        <li <?php echo ($this->uri->segment(1) == "customer") ? 'class="active"' : '' ?>>
                            <a href="<?php echo site_url('customer') ?>">Inicio Cliente</a>
                        </li>
                        <li class="dropdown <?php echo ($this->uri->segment(1) == 'administrator') ? 'active' : '' ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catálogos <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li <?php echo ($this->uri->segment(2) == "users") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('administrator/users') ?>">Usuarios</a>
                                </li>
                                <li <?php echo ($this->uri->segment(2) == "group_types") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('administrator/group_types') ?>">Tipos de grupos</a>
                                </li>
                                <li <?php echo ($this->uri->segment(2) == "groups") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('administrator/groups') ?>">Grupos</a>
                                </li>
                                <li <?php echo ($this->uri->segment(2) == "customers") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('administrator/customers') ?>">Clientes</a>
                                </li>
                                <li <?php echo ($this->uri->segment(2) == "managers") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('administrator/managers') ?>">Gestores</a>
                                </li>
                                <li <?php echo ($this->uri->segment(2) == "providers") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('administrator/providers') ?>">Proveedores</a>
                                </li>
                                <li <?php echo ($this->uri->segment(2) == "products") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('administrator/products') ?>">Productos</a>
                                </li>
                                <li <?php echo ($this->uri->segment(2) == "section_types") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('administrator/section_types') ?>">Tipos de sección</a>
                                </li>
                                <li <?php echo ($this->uri->segment(2) == "sections") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('administrator/sections') ?>">Secciones</a>
                                </li>
                                <li <?php echo ($this->uri->segment(2) == "menu_types") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('administrator/menu_types') ?>">Tipos de menú</a>
                                </li>
                                <li <?php echo ($this->uri->segment(2) == "menus") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('administrator/menus') ?>">Menus</a>
                                </li>
                            </ul>
                        </li>
                        <li <?php echo ($this->uri->segment(1) == "#") ? 'class="active"' : '' ?>>
                            <a href="<?php echo site_url('administrator') ?>">Informes</a>
                        </li>
                        <li <?php echo ($this->uri->segment(1) == "exit") ? 'class="active"' : '' ?>>
                            <a href="<?php echo site_url('exit') ?>">Salir</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
        <div class="container">
            <div id="content">
                <?php $this->load->view($viewToLoad) ?>
            </div>
        </div>
        <footer>
            <?php $this->load->view('comunes/footer') ?>
        </footer>

        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="node_modules/jquery-ui-dist/jquery-ui.min.js"></script>
        <script src="js/virtualmenu.js"></script>
        <?php
        if (isset($js_files)) {
            foreach ($js_files as $file) {
                ?>
                <script src="<?php echo $file; ?>"></script>
                <?php
            }
        }
        ?>        
    </body>
</html>
