<?php
/*
 * Cabecera de la plantilla principal.
 * 
 * @author Leoanrdo Quintero
 */
?>

                <script>
                    $(function() {
                        $(".buttonMenu").button();
                    });
                </script>

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
                    <br><br>
                    <?php
                    $page = $this->uri->segment(1);
                    if ($this->providerUriName == DOMAIN_NAME) {
                        ?>        
                        <?php
                        if ($page != 'login') {
                            ?>
                            <a class="buttonMenu" href="<?php echo site_url('login') ?>">Iniciar sesión</a>
                        <?php } ?>
                    <?php } elseif ($page != 'register') {
                        ?>
                        <a class="buttonMenu" href="<?php echo site_url('register') ?>">Crear cuenta</a>
                        <?php
                    }
                    ?>
                </div>
