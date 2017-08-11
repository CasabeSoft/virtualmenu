<h1 class="formTitle">Contacto</h1>
<div class="form">
    <?php
    if (isset($error)) {
        ?>
        <div class="text-danger">
            <?php echo $error ?>
        </div>
        <?php
    }
    ?>
    <?php
    if (isset($message)) {
        ?>
        <div class="text-info">
            <?php echo $message ?>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <form action="<?php echo site_url('contact') ?>" method="post" accept-charset="utf-8" class="col-sm-12" id="formContact">
            <div class="form-group">
                <label for="message">Mensaje:</label>
                <textarea class="form-control" name="message" rows="6"><?php echo set_value('message'); ?></textarea>
                <div class="text-danger"><?php echo form_error('message'); ?></div>
            </div>

            <button type="submit" class="btn btn-default">Enviar</button>
        </form>
    </div>
</div>
