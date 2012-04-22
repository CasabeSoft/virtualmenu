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
