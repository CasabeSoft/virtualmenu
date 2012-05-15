<?php
/**
 * Perfir del usuario.
 * 
 * @author Leoanrdo Quintero
 */
?>
<script>
    $(function() {
        $(".button").button();
    });   
</script>
<h1 class="formTitle">Configurar cuenta de usuario.</h1>
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
    <form action="<?php echo site_url('profile') ?>" method="post" accept-charset="utf-8" class="formProfile" id="formProfile">
        <div class="formLabel"><label for="email">Correo:</label></div>
        <div class="formData">
            <?php echo $this->session->userdata('email'); ?>
            <!--input type="text" readonly name="email" value="" id="email" maxlength="250" size="50" style="width:50%"  /-->
        </div>
        <div class="formError"><?php echo form_error('email'); ?></div>
        <div class="formClear">&nbsp;</div>

        <div class="formLabel"><label for="username">Nombre:</label></div>
        <div class="formData">                 
            <input type="text" name="name" value="<?php echo $this->session->userdata('name'); //set_value('name');  ?>" id="name" maxlength="50" size="50" style="width:50%"  />
        </div>
        <div class="formError"><?php echo form_error('name'); ?></div>
        <div class="formClear">&nbsp;</div>

        <div class="formLabel"><label for="address">Dirección:</label></div>
        <div class="formData">                 
            <input type="text" name="address" value="<?php echo set_value('address'); ?>" id="address" maxlength="50" size="50" style="width:50%"  />
        </div>
        <div class="formError"><?php echo form_error('address'); ?></div>
        <div class="formClear">&nbsp;</div>

        <div class="formLabel"><label for="phone">Teléfono:</label></div>
        <div class="formData">                 
            <input type="text" name="phone" value="<?php echo set_value('phone'); ?>" id="phone" maxlength="50" size="50" style="width:50%"  />
        </div>
        <div class="formError"><?php echo form_error('phone'); ?></div>
        <div class="formClear">&nbsp;</div>

        <div class="formLabel"><label for="group">Grupo:</label></div>
        <div class="formData">   
            <input type="hidden" id="group" name="group" value="<?php echo set_value('group'); ?>" />
            <input type="text" name="groupName" id="groupName" maxlength="50" size="50" style="width:50%"  />
        </div>
        <div class="formError"><?php echo form_error('group'); ?></div>
        <div class="formClear">&nbsp;</div>

        <div class="formLabel"><label for="photo">Foto:</label></div>
        <div class="formData">   
            <input type="file" name="photo" id="photo" maxlength="50" size="50" style="width:50%"  />
        </div>
        <div class="formError"><?php echo form_error('group'); ?></div>
        <div class="formClear">&nbsp;</div>

        <div class="formButton">
            <input type="submit" class="button" value="Aceptar"/>
            <br><br>
            <a href="<?php echo site_url('changePassword') ?>"><input type="button" class="button" value="Cambiar contraseña"/></a>
        </div>
        <div class="formClear">&nbsp;</div>
    </form>
</div>
