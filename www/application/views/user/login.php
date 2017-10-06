<h1>Iniciar sesión</h1>

<div class="form">
    <?php
    if (isset($error)) {
        ?>
        <div class="text-danger">
            <?php echo $error; ?>
        </div>
        <?php
    }
    ?>
    <?php
    if (isset($message)) {
        ?>
        <div class="text-info">
            <?php echo $message; ?>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <form action="<?php echo site_url('login') ?>" method="post" accept-charset="utf-8" class="col-sm-6" id="formLogin">
            <div class="form-group">
                <label for="email">Correo:</label>
                <input class="form-control" type="text" name="email" value="<?php echo set_value('email'); ?>" id="email" maxlength="255"  />
                <div class="text-danger"><?php echo form_error('email'); ?></div>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input class="form-control" type="password" name="password" value="" id="password" maxlength="32" />
                <div class="text-danger"><?php echo form_error('password'); ?></div>
            </div>

            <button type="submit" class="btn btn-default">Iniciar sesión</button>
        </form>
    </div>
</div>
