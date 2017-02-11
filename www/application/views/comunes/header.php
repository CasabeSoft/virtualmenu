<?php
/*
 * Cabecera de la plantilla principal.
 *
 * @author Leoanrdo Quintero
 */
?>
<div class="prepend-0_1 span-3">
    <a href="<?php echo $this->providerWeb; ?>" target="_blank"><img alt="Logo" src="<?php echo $this->theme; ?>/images/logo.png" /></a>
</div>
<div class="span-15">
    <h1><?php echo $this->providerName; ?></h1>
    <h2>Menú Virtual</h2>
</div>
<div class="span-5 last">
    <br><br>
    <?php
    $page = $this->uri->segment(1);
    if ($this->providerUriName == DOMAIN_NAME) { ?>
        <?php if ($page != 'login') { ?>
            <a class="button" href="<?php echo site_url('login') ?>">Iniciar sesión</a>
        <?php } ?>
    <?php
    } elseif ($page != 'register') { ?>
        <a class="button" href="<?php echo site_url('register') ?>">Crear cuenta</a> <?php
    }
    ?>
</div>
<hr class="space">
