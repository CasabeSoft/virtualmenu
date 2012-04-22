<?php
/**
 * Plantilla principal.
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
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/sunny/jquery-ui.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="container">
            <?php $this->load->view('comunes/header') ?>

            <?php $this->load->view($viewToLoad) ?>

            <?php $this->load->view('comunes/footer') ?>
        </div>
    </body>
</html>
