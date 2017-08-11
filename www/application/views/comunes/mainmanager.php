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
                        <li class="dropdown <?php echo ($this->uri->segment(1) == 'menu') ? 'active' : '' ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menús <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li <?php echo ($this->uri->segment(2) == "manage") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('menu/manage') ?>">Crear</a>
                                </li>
                                <li <?php echo ($this->uri->segment(2) == "order") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('menu/order') ?>">Pedir</a>
                                </li>
                            </ul>
                        </li>
                        <li <?php echo ($this->uri->segment(2) == "products") ? 'class="active"' : '' ?>>
                            <a href="<?php echo site_url('manager/products') ?>">Productos</a>
                        </li>
                        <li class="dropdown <?php echo ($this->uri->segment(2) == 'reports') ? 'active' : '' ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informes <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li <?php echo ($this->uri->segment(3) == "dayresume") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('manager/reports/dayresume') ?>">Resumen de pedidos del día</a>
                                </li>
                                <li <?php echo ($this->uri->segment(3) == "daydetail") ? 'class="active"' : '' ?>>
                                    <a href="<?php echo site_url('manager/reports/daydetail') ?>">Detalle de pedidos del día</a>
                                </li>
                            </ul>
                        </li>
                        <li <?php echo ($this->uri->segment(1) == "profile") ? 'class="active"' : '' ?>>
                            <a href="<?php echo site_url('profile') ?>">Opciones</a>
                        </li>
                        <li <?php echo ($this->uri->segment(1) == "exit") ? 'class="active"' : '' ?>>
                            <a href="<?php echo site_url('exit') ?>">&ensp;Salir&ensp;</a>
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
