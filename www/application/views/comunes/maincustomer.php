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
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <?php $this->load->view('comunes/brand') ?>
                <nav class="collapse navbar-collapse" id="main-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?php echo site_url('menu/order') ?>" <?php echo ($this->uri->segment(2) == "order") ? 'class="active"' : '' ?>>Ordenar</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('profile') ?>" <?php echo ($this->uri->segment(1) == "profile") ? 'class="active"' : '' ?>>Opciones</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('exit') ?>" <?php echo ($this->uri->segment(1) == "exit") ? 'class="active"' : '' ?>>Salir</a>
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
    </body>
</html>
