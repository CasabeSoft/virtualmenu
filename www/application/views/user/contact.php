<?php
/**
 * Formulario para contactar con el gestor.
 *
 * @author Leoanrdo Quintero
 */
?>

                <script>
                    $(".button").button();
                </script>

                <h1 class="formTitle">Contacto</h1>
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
                    <form action="<?php echo site_url('contact') ?>" method="post" accept-charset="utf-8" class="formContact" id="formContact">
                        <div class="formLabel"><label for="message">Mensaje:</label></div>
                        <div class="formData">
                            <textarea name="message" style="width:50%" size="50" ><?php echo set_value('message'); ?></textarea>
                        </div>
                        <div class="formError"><?php echo form_error('message'); ?></div>
                        <div class="formClear">&nbsp;</div>

                        <div class="formButton">
                            <input type="submit" class="button" value="Aceptar"/>
                        </div>
                        <div class="formClear">&nbsp;</div>
                    </form>
                </div>
