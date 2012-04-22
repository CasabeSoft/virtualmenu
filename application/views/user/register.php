<?php

/**
 * Formulario para registrar un usuario nuevo.
 * 
 * @author Leoanrdo Quintero
 */
?>

            <div id="content">
                <h1 class="title">Register</h1>
                <br>
                <div class="formulario">
                    <form action="<?php echo site_url('registrar') ?>" method="post" accept-charset="utf-8" class="form_register" id="form_register">
                        <div class="texto_formulario"><label for="username">Nombre:</label></div>
                        <div class="type_formulario">                 
                            <input type="text" name="name" value="<?php echo set_value('name'); ?>" id="name" maxlength="50" size="50" style="width:50%"  />
                        </div>
                        <div class="error_formulario"><?php echo form_error('name'); ?></div>
                        <div class="clear">&nbsp;</div>
                        
                        <div class="texto_formulario"><label for="phone">Teléfono:</label></div>
                        <div class="type_formulario">                 
                            <input type="text" name="phone" value="<?php echo set_value('phone'); ?>" id="phone" maxlength="50" size="50" style="width:50%"  />
                        </div>
                        <div class="error_formulario"><?php echo form_error('phone'); ?></div>
                        <div class="clear">&nbsp;</div>
                        
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

                        <div class="texto_formulario"><label for="re_password">Repetir contraseña:</label></div>
                        <div class="type_formulario">                 
                            <input type="re_password" name="re_password" value="" id="re_password" maxlength="50" size="50" style="width:50%"  />
                        </div> 
                        <div class="error_formulario"><?php echo form_error('re_password'); ?></div>  
                        <div class="clear">&nbsp;</div>
                        
                        <div class="type_formulario" style="padding-left: 180px;">
                            <input type="submit" name="submit" value="Aceptar"  />
                            <div>
                                <?php //echo anchor('autenticar', 'Login'); ?>
                            </div>
                            <div>
                                <?php //echo anchor('user/remenberPassword', 'Recordar contraseña'); ?>
                            </div>
                        </div>
                        <div class="clear">&nbsp;</div>
                    </form>
                </div>
                