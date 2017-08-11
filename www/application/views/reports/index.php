<?php
/**
 * Página principal del administrador.
 */
?>

<div>
    <h1>Informes</h1>
    <hr>
    <div>
        <?php
        if (isset($report)) {
            $this->load->view($report);
        }
        ?>
    </div>
</div>
