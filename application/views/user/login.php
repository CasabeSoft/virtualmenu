<?php

/**
 * Formulario para autenticar usuarios.
 * 
 * @author Leoanrdo Quintero
 */
?>

            <h1 class="title">Login</h1>
            <br>
            <div class="formulario">

                <?php
                if (isset($error) && $error == 1) {
                    ?>   
                    <div class="error" style="padding-left: 190px;">
                        Revise los campos por favor. El nombre de usuario o contraseña no son correctos.
                    </div>
                    <div class="clear">&nbsp;</div>
                    <?php
                }
                ?>
                <form action="<?php echo site_url('autenticar') ?>" method="post" accept-charset="utf-8" class="form_login" id="form_login">
                    <!--div class="texto_formulario"><label for="username">Usuario:</label></div>
                    <div class="type_formulario">                 
                        <input type="text" name="username" value="<?php //echo set_value('username'); ?>" id="username" maxlength="50" size="50" style="width:50%"  />
                    </div>
                    <div class="error_formulario"><?php //echo form_error('username'); ?></div>
                    <div class="clear">&nbsp;</div-->

                    <div class="texto_formulario"><label for="email">Correo:</label></div>
                    <div class="type_formulario">                 
                        <input type="text" name="email" value="<?php echo set_value('email'); ?>" id="email" maxlength="50" size="50" style="width:50%"  />
                    </div>
                    <div class="error_formulario"><?php echo form_error('email'); ?></div>
                    <div class="clear">&nbsp;</div>

                    <div class="texto_formulario"><label for="password">Contraseña:</label></div>
                    <div class="type_formulario">                 
                        <input type="password" name="password" value="" id="password" maxlength="50" size="50" style="width:50%"  />
                    </div> 
                    <div class="error_formulario"><?php echo form_error('password'); ?></div>  
                    <div class="clear">&nbsp;</div>

                    <div class="type_formulario" style="padding-left: 180px;">
                        <input type="submit" name="submit" value="Aceptar"  />
                        <div>
                            <?php //echo anchor('registrar', 'Crear cuenta'); ?>
                        </div>
                    </div>
                    <div class="clear">&nbsp;</div>
                </form>
            </div>
