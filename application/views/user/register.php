<?php
/**
 * Formulario para registrar un usuario nuevo.
 * 
 * @author Leoanrdo Quintero
 */
?>
                <script>
                    $(function() {
                        var availableGroups = <?php echo $groups ?>

                        $( "#groupName" ).autocomplete({
                            source: availableGroups,
                            select: function(event, ui) { 
                                $("#groupName").val(ui.item.label);
                                $("#group").val(ui.item.value);
                                return false;
                            }
                        });

                        $(".button").button();
                    });
                </script>

                <h1 class="formTitle">Crear cuenta</h1>
                <br>
                <div class="form">
                    <?php
                    if (isset($error)) {
                        ?>   
                        <div class="formError">
                            <?php echo $error ?>
                        </div>
                        <div class="formClear">&nbsp;</div>
                        <?php
                    }
                    ?>
                    <form action="<?php echo site_url('register') ?>" method="post" accept-charset="utf-8" class="formRegister" id="formRegister">
                        <div class="formLabel"><label for="username">Nombre:</label></div>
                        <div class="formData">                 
                            <input type="text" name="name" value="<?php echo set_value('name'); ?>" id="name" maxlength="100" style="width:50%"  />
                        </div>
                        <div class="formError"><?php echo form_error('name'); ?></div>
                        <div class="formClear">&nbsp;</div>

                        <div class="formLabel"><label for="address">Dirección:</label></div>
                        <div class="formData">                 
                            <input type="text" name="address" value="<?php echo set_value('address'); ?>" id="address" maxlength="255" style="width:50%"  />
                        </div>
                        <div class="formError"><?php echo form_error('address'); ?></div>
                        <div class="formClear">&nbsp;</div>

                        <div class="formLabel"><label for="phone">Teléfono:</label></div>
                        <div class="formData">                 
                            <input type="text" name="phone" value="<?php echo set_value('phone'); ?>" id="phone" maxlength="10" style="width:50%"  />
                        </div>
                        <div class="formError"><?php echo form_error('phone'); ?></div>
                        <div class="formClear">&nbsp;</div>

                        <div class="formLabel"><label for="group">Grupo:</label></div>
                        <div class="formData">   
                            <input type="hidden" name="group" id="group" value="<?php echo set_value('group'); ?>" />
                            <input type="text" name="groupName" id="groupName" value="<?php echo set_value('groupName'); ?>" maxlength="11" style="width:50%"  />
                        </div>
                        <div class="formError"><?php echo form_error('group'); ?></div>
                        <div class="formClear">&nbsp;</div>

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

                        <div class="formLabel"><label for="re_password">Repetir contraseña:</label></div>
                        <div class="formData">                 
                            <input type="password" name="re_password" value="" id="re_password" maxlength="32" style="width:50%"  />
                        </div> 
                        <div class="formError"><?php echo form_error('re_password'); ?></div>  
                        <div class="formClear">&nbsp;</div>

                        <div class="formButton">
                            <input type="submit" class="button" value="Aceptar"/>
                            <br><br>
                            <a href="<?php echo site_url('login') ?>"><input type="button" class="button" value="Iniciar sesión"/></a>
                        </div>
                        <div class="formClear">&nbsp;</div>
                    </form>
                </div>
