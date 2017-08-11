<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <?php $this->load->view('comunes/brand') ?>
        <nav class="collapse navbar-collapse" id="main-menu">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?php
                    $page = $this->uri->segment(1);
                    if ($this->providerUriName == DOMAIN_NAME) {
                        ?>
                        <?php if ($page != 'login') { ?>
                            <a class="button" href="<?php echo site_url('login') ?>">Iniciar sesión</a>
                        <?php } elseif ($page != 'register') {
                        ?>
                        <a class="button" href="<?php echo site_url('register') ?>">Crear cuenta</a>
                        <?php }
                    }
                    ?>
                </li>
            </ul>
        </nav>
    </div>
</nav>

