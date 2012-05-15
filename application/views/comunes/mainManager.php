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
        <link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->theme ?>/css/provider.css" rel="stylesheet" type="text/css" />
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
        <?php
        if (isset($js_files)) {
            foreach ($js_files as $file):
                ?>
                <script src="<?php echo $file; ?>"></script>
                <?php
            endforeach;
        }
        ?>
        <script type="text/javascript">
            $(function() {
                $(".button").button();
                $("#btnUserArrow").button({
                    text: false,
                    icons: {
                        primary: "ui-icon-triangle-1-s"
                    }
                });
                $("#buttonUser").buttonset();

            });
        </script>
        <style>
            #userMenu { display: none; width: 300px; font-size: 1.2em }
            #userMenu img { width: 100px; height: 100px; margin: 10px; }
            #userOptions { float: right; width: 300px;}
            #buttonUser  { float: right;}
            #userOptions:hover #userMenu { display: block; position: absolute; }
        </style>                
    </head>
    <body>
        <div id="container">
            <div id="header">
                <div id="headerLogo">
                    <a href="<?php echo $this->providerWeb; ?>" target="_blank"><img alt="Logo" src="<?php echo $this->theme; ?>/images/logo.png" /></a>    
                </div>

                <div id="headerTitle">
                    <br>
                    <h1>Menú Virtual</h1> 
                    <br>
                    <h1><?php echo $this->providerName; ?></h1> 
                </div>

                <div id="headerMenu">
                    <?php
                    if (($this->providerUriName != DOMAIN_NAME)) {
                        ?>
                        <br>
                        <div id="userOptions">
                            <div id="buttonUser">
                                <button id="btnUserText"><?php echo $this->session->userdata('email'); ?></button><button id="btnUserArrow">Perfil</button>
                            </div>
                            <div style="clear: both; "></div>
                            <div id="userMenu" class="last ui-widget ui-widget-content ui-corner-all">
                                <img src="" alt="Foto del usuario"  align="left" />
                                <p id="userName"><?php echo $this->session->userdata('name'); ?></p>
                                <p id="email"><?php echo $this->session->userdata('email'); ?></p>
                                <a href="<?php echo site_url('profile') ?>">Configurar cuenta</a>
                                <dir style="clear: both"></dir>
                                <div style="background-color: #ddd; height: 60px">
                                    <br>
                                    &nbsp;&nbsp;
                                    <a href="<?php echo site_url('exit') ?>"><input type="button" class="button" value="Cerrar sesión"/></a>
                                </div>
                            </div>
                        </div>
                        <dir style="clear: both"></dir>
                    <?php } ?>

                    <br>
                    <a href="<?php echo site_url('menu/manage') ?>">Menús</a> |
                    <a href="<?php echo site_url('manager/products') ?>">Productos</a> |
                    <a href="<?php echo site_url('#') ?>">Opción1</a> |
                    <a href="<?php echo site_url('#') ?>">Opción2</a>
                </div>
            </div>
            <div id="content">
                <?php $this->load->view($viewToLoad) ?>
            </div>
            <div id="footer">
                <p id="copy">&copy;2012 Vertul Menu.</p>
            </div>
        </div>
    </body>
</html>
