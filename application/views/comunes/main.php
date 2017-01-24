<?php
/**
 * Plantilla principal.
 *
 * @author Leonardo Quintero
 * @author Carlos Bello
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <!-- Framework CSS -->
        <link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
        <link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print">
        <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
        <!-- Import fancy-type plugin for the sample page. -->
        <link rel="stylesheet" href="css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
        <!-- End Framework CSS -->
        <link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/cupertino/jquery-ui.css" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/virtualmenu.js"></script>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->theme ?>/css/provider.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="<?php echo $this->theme ?>/images/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        <div class="container">
            <div id="header">
                <?php $this->load->view('comunes/header') ?>
            </div>
            <div id="content">
                <?php $this->load->view($viewToLoad) ?>
            </div>
            <div id="footer" class="span-24 last">
                <?php $this->load->view('comunes/footer') ?>
            </div>
        </div>
    </body>
</html>
