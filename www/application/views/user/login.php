<?php
/**
 * Formulario para autenticar usuarios.
 *
 * @author Leoanrdo Quintero
 */
?>

                <script>
                    $(function() {
                        $(".button").button();
                    });
                </script>

                <h1 class="formTitle">Iniciar sesión</h1>
                <br>
                <div class="form">
                    <?php
                    if (isset($error)) {
                        ?>
                        <div class="formError">
                            <?php echo $error; ?>
                        </div>
                        <div class="formClear">&nbsp;</div>
                        <?php
                    }
                    ?>
                    <?php
                    if (isset($message)) {
                        ?>
                        <div class="formMessagge">
                            <?php echo $message; ?>
                        </div>
                        <div class="formClear">&nbsp;</div>
                        <?php
                    }
                    ?>
                    <form action="<?php echo site_url('login') ?>" method="post" accept-charset="utf-8" class="formLogin" id="formLogin">
                        <div class="formLabel"><label for="email">Correo:</label></div>
                        <div class="formData">
                            <input type="text" name="email" value="<?php echo set_value('email'); ?>" id="email" maxlength="255" style="width:50%"  />
                        </div>
                        <div class="formError"><?php echo form_error('email'); ?></div>
                        <div class="formClear">&nbsp;</div>

                        <div class="formLabel"><label for="password">Contraseña:</label></div>
                        <div class="formData">
                            <input type="password" name="password" value="" id="password" maxlength="32" style="width:50%"  />
                        </div>
                        <div class="formError"><?php echo form_error('password'); ?></div>
                        <div class="formClear">&nbsp;</div>

                        <div class="formButton">
                            <input type="submit" class="button" value="Aceptar"  />
                            <br><br>
                            <a class="button" href="<?php echo site_url('rememberPassword') ?>">Recordar contraseña</a>
                        </div>
                        <div class="formClear">&nbsp;</div>
                    </form>
                </div>
