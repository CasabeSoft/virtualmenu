<?php
/**
 * Listado de usuarios.
 * 
 * @author Leoanrdo Quintero
 */
?>
        <script>
            $(function() {
                $(".button").button();
            });   
        </script>
        <h1 class="formTitle">Recordar contraseña.</h1>
        <br>
        <p align="center" style="font-size: 1.3em;">Por favor, introduzca su correo electrónico para que podamos enviar un correo electrónico para restablecer tu contraseña.</p>
        <br>
        <div class="form">
            <?php
            if (isset($error) && $error == 1) {
                ?>   
                <div class="formError">
                    No se pudo enviar el correo electrónico. Por favor intenta nuevamente, si el error continúa debe contactar con el servicio técnico.
                </div>
                <div class="formClear">&nbsp;</div>
                <?php
            }
            ?>
            <form action="<?php echo site_url('rememberPassword') ?>" method="post" accept-charset="utf-8" class="formRememberPassword" id="formRememberPassword">
                <div class="formLabel"><label for="email">Correo:</label></div>
                <div class="formData">                 
                    <input type="text" name="email" value="<?php echo set_value('email'); ?>" id="email" maxlength="250" size="50" style="width:50%"  />
                </div>
                <div class="formError"><?php echo form_error('email'); ?></div>
                <div class="formClear">&nbsp;</div>
                
                <div class="formButton">
                    <input type="submit" class="button" value="Aceptar"/>
                    <br><br>
                    <a href="<?php echo site_url('login') ?>"><input type="button" class="button" value="Iniciar sesión"/></a>
                </div>
                <div class="formClear">&nbsp;</div>
            </form>
        </div>
