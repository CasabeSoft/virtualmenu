<?php
/**
 * Página principal del administrador.
 * 
 * @author Carlos Bello
 */
?>

<div class="prepend-0_1 prepend-top">
    <h1>Informes</h1>
    <hr class="span-23 last">
    <div class="span-23 last">
        <?php if (isset($report)) $this->load->view($report) ?>
    </div>
</div>
