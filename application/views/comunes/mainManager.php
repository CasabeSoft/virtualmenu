<?php
/**
 * Plantilla principal para el Gestor.
 * 
 * @author Leonardo Quintero 
 */
//1.8.18
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
        <script type="text/javascript" src="js/virtualmenu.js"></script>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->theme ?>/css/provider.css" rel="stylesheet" type="text/css" />
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
                        <div id="userOptions">
                            <div id="userButton">
                                <button id="btnUserText"><?php echo $this->session->userdata('email'); ?></button><button id="btnUserArrow">Perfil</button>
                            </div>
                            <div style="clear: both; "></div>
                            <div id="userMenu" class="last ui-widget ui-widget-content ui-corner-all">
                                <img src="" alt="Foto del usuario"  align="left" />
                                <p id="userName"><?php echo $this->session->userdata('name'); ?></p>
                                <p id="userEmail"><?php echo $this->session->userdata('email'); ?></p>
                                <a class="button" href="<?php echo site_url('profile') ?>">Configurar cuenta</a>
                                <dir style="clear: both"></dir>
                                <div id="userMore">
                                    <a class="button" href="<?php echo site_url('exit') ?>">Cerrar sesión</a>
                                </div>
                            </div>
                        </div>
                        <dir style="clear: both"></dir>
<?php } ?>
                    <div id="appMenu">
                        <a class="button" href="<?php echo site_url('menu/manage') ?>">Menús</a>
                        <a class="button" href="<?php echo site_url('manager/products') ?>">Productos</a>
                        <a class="button" href="<?php echo site_url('#') ?>">Opción 1</a>
                        <a class="button" href="<?php echo site_url('#') ?>">Opción 2</a>
                    </div>
                </div>
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
