<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <title><?php echo $title; ?></title>
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
    </head>
    <body>
        <header>
            <?php $this->load->view('comunes/header') ?>
        </header>
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
    </body>
</html>
