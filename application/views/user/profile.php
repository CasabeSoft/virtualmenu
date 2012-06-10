<?php
/**
 * Perfir del usuario.
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
                    });
                </script>
                <h1 class="formTitle">Configurar cuenta de usuario.</h1>
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
                    <?php
                    if (isset($message)) {
                        ?>   
                        <div class="formMessagge">
                            <?php echo $message ?>
                        </div>
                        <div class="formClear">&nbsp;</div>
                        <?php
                    }
                    ?>
                    <form action="<?php echo site_url('profile') ?>" method="post" accept-charset="utf-8" class="formProfile" id="formProfile">
                        <div class="formLabel"><label for="email">Correo:</label></div>
                        <div class="formData">
                            <?php echo $user->email; //$this->session->userdata('email'); ?>
                            <!--input type="text" readonly name="email" value="" id="email" maxlength="255" style="width:50%"  /-->
                        </div>
                        <div class="formError"><?php echo form_error('email'); ?></div>
                        <div class="formClear">&nbsp;</div>

                        <div class="formLabel"><label for="username">Nombre:</label></div>
                        <div class="formData">                 
                            <input type="text" name="name" value="<?php echo set_value('name', $user->name); //$this->session->userdata('name');  ?>" id="name" maxlength="100" style="width:50%"  />
                        </div>
                        <div class="formError"><?php echo form_error('name'); ?></div>
                        <div class="formClear">&nbsp;</div>
                        
                        <div class="formLabel"><label for="phone">Teléfono:</label></div>
                        <div class="formData">                 
                            <input type="text" name="phone" value="<?php echo set_value('phone', $user->phone); ?>" id="phone" maxlength="10" style="width:50%"  />
                        </div>
                        <div class="formError"><?php echo form_error('phone'); ?></div>
                        <div class="formClear">&nbsp;</div>

                        <?php
                        if ($this->session->userdata('rol') == ROL_CUSTOMER) {
                            ?> 
                            <div class="formLabel"><label for="address">Dirección:</label></div>
                            <div class="formData">                 
                                <input type="text" name="address" value="<?php echo set_value('address', $user->address); ?>" id="address" maxlength="255" style="width:50%"  />
                            </div>
                            <div class="formError"><?php echo form_error('address'); ?></div>
                            <div class="formClear">&nbsp;</div>

                            <div class="formLabel"><label for="group">Grupo:</label></div>
                            <div class="formData">   
                                <input type="hidden" name="group" id="group" value="<?php echo set_value('group', $user->group); ?>" />
                                <input type="text" name="groupName" id="groupName" value="<?php echo set_value('groupName', $groupName); ?>" maxlength="11" style="width:50%"  />
                            </div>
                            <div class="formError"><?php echo form_error('group'); ?></div>
                            <div class="formClear">&nbsp;</div>
                            <?php
                        }
                        ?>
                        <!--div class="formLabel"><label for="photo">Foto:</label></div>
                        <div class="formData">   
                            <input type="file" name="photo" id="photo" maxlength="255" size="41" style="width:50%"  />
                        </div>
                        <div class="formError"><?php //echo form_error('photo');    ?></div>
                        <div class="formClear">&nbsp;</div-->

                        <div class="formButton">
                            <input type="submit" class="button" value="Aceptar"/>
                            <br><br>
                            <a href="<?php echo site_url('changePassword') ?>"><input type="button" class="button" value="Cambiar contraseña"/></a>
                        </div>
                        <div class="formClear">&nbsp;</div>
                    </form>
                </div>
