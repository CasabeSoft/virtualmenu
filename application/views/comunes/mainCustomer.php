<?php
/**
 * Plantilla Cliente principal.
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
        <link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/sunny/jquery-ui.css" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="container">
            <?php $this->load->view('comunes/headerCustomer') ?>
            <div id="content">
                <?php $this->load->view($viewToLoad) ?>
            </div>
            <?php $this->load->view('comunes/footerCustomer') ?>
        </div>
    </body>
</html>
