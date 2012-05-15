<?php
/*
 * Cabecera de la plantilla para el Gestor.
 * 
 * @author Leoanrdo Quintero
 */
?>

<script type="text/javascript">
    $(function() {
        $(".button").button();
        $("#btnUserArrow").button({
            text: false,
            icons: {
                primary: "ui-icon-triangle-1-s"
            }
        });
        $("#buttonUser").buttonset();

    });
</script>
<style>
    #menu { position: relative; }
    #userMenu { display: none; width: 300px; font-size: 1.2em }
    #userMenu img { width: 100px; height: 100px; margin: 10px; }
    #userOptions { float: right; width: 300px;}
    #buttonUser  { float: right;}
    #userOptions:hover #userMenu { display: block; position: absolute; }
    #content { font-size: 1.2em }
</style>

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
    <?php
    if (($this->providerUriName != DOMAIN_NAME)) {
        ?>
        <br>
        <div id="userOptions">
            <div id="buttonUser">
                <button id="btnUserText"><?php echo $this->session->userdata('email'); ?></button><button id="btnUserArrow">Perfil</button>
            </div>
            <div style="clear: both; "></div>
            <div id="userMenu" class="last ui-widget ui-widget-content ui-corner-all">
                <img src="" alt="Foto del usuario"  align="left" />
                <p id="userName"><?php echo $this->session->userdata('name'); ?></p>
                <p id="email"><?php echo $this->session->userdata('email'); ?></p>
                <a href="<?php echo site_url('profile') ?>">Configurar cuenta</a>
                <dir style="clear: both"></dir>
                <div style="background-color: #ddd; height: 60px">
                    <br>
                    &nbsp;&nbsp;
                    <a href="<?php echo site_url('exit') ?>"><input type="button" class="button" value="Cerrar sesión"/></a>
                </div>
            </div>
        </div>
        <dir style="clear: both"></dir>
    <?php } ?>

    <br>
    <a href="<?php echo site_url('manager/products') ?>">Productos</a> |
    <a href="<?php echo site_url('#') ?>">Opción1</a> |
    <a href="<?php echo site_url('#') ?>">Opción2</a>

</div>
