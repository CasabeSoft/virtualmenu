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
        <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="container">
            <div id="header">
                <?php $this->load->view('comunes/headerManager') ?>
            </div>
            <div id="content">
                <?php $this->load->view($viewToLoad) ?>
            </div>
            <div id="footer">
                <?php $this->load->view('comunes/footerManager') ?>
            </div>
        </div>
    </body>
</html>
