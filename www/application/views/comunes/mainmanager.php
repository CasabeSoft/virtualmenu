<?php
/**
 * Plantilla principal para el Gestor.
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
            foreach ($css_files as $file) {
                ?>
                <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
                <?php
            };
        }
        ?>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->theme ?>/css/provider.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <?php
        if (isset($js_files)) {
            foreach ($js_files as $file) {
                ?>
                <script src="<?php echo $file; ?>"></script>
                <?php
            };
        }
        ?>
        <script type="text/javascript" src="js/virtualmenu.js"></script>
        <script type="text/javascript" >
            $(function() {
                $(".button").button();
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div id="header" class="clearfix">
                <div class="prepend-0_1 span-3">
                    <a href="<?php echo $this->providerWeb; ?>" target="_blank"><img alt="Logo" src="<?php echo $this->theme; ?>/images/logo.png" /></a>
                </div>
                <h1 class="span-20 last"><?php echo $this->providerName; ?></h1>
                <h2 class="span-8">Menú Virtual</h2>
                <div class="span-12 last">
                    <div class="bar nav">
                        <div class="nav-outer">
                            <div class="nav-wrapper">
                                <div class="nav-inner">
                                    <ul class="hmenu">
                                        <li>
                                            <a href="<?php echo site_url('menu/manage') ?>" <?php echo ($this->uri->segment(2) == "manage") ? 'class="active"' : '' ?>>Menús</a>
                                            <ul>
                                                <li><a href="<?php echo site_url('menu/manage') ?>">Crear</a></li>
                                                <li><a href="<?php echo site_url('menu/order') ?>">Pedir</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('manager/products') ?>" <?php echo ($this->uri->segment(2) == "products") ? 'class="active"' : '' ?>>Productos</a>
                                        </li>


                                        <li>
                                            <a href="<?php echo site_url('manager/reports') ?>" <?php echo ($this->uri->segment(2) == "reports") ? 'class="active"' : '' ?>>Informes</a>
                                            <ul>
                                                <li>
                                                    <a href="<?php echo site_url('manager/reports/dayresume') ?>" <?php echo ($this->uri->segment(3) == "dayresume") ? 'class="active"' : '' ?>>Resumen de pedidos del día</a>
                                                </li>
                                                <!--li>
                                                    <a href="<?php //echo site_url('manager/reports/weekresume') ?>" <?php echo ($this->uri->segment(3) == "weekresume") ? 'class="active"' : '' ?>>Resumen de pedidos de la semana</a>

                                                </li>
                                                <li>
                                                    <a href="<?php //echo site_url('manager/reports/monthresume') ?>" <?php echo ($this->uri->segment(3) == "monthresume") ? 'class="active"' : '' ?>>Resumen de pedidos del mes</a>
                                                </li-->
                                                <li>
                                                    <a href="<?php echo site_url('manager/reports/daydetail') ?>" <?php echo ($this->uri->segment(3) == "daydetail") ? 'class="active"' : '' ?>>Detalle de pedidos del día</a>
                                                </li>
                                                <!--li>
                                                    <a href="<?php //echo site_url('manager/reports/clients') ?>" <?php echo ($this->uri->segment(3) == "clients") ? 'class="active"' : '' ?>>Listado de clientes</a>
                                                </li-->
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('profile') ?>" <?php echo ($this->uri->segment(1) == "profile") ? 'class="active"' : '' ?>>Opciones</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('exit') ?>" <?php echo ($this->uri->segment(1) == "exit") ? 'class="active"' : '' ?>>&ensp;Salir&ensp;</a>
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
