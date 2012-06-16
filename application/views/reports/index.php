<?php
/**
 * Página principal del administrador.
 * 
 * @author Carlos Bello
 */
?>
<style>
    ul { padding:0; margin:0; }
</style>
<div class="prepend-0_1 prepend-top">
    <h1>Informes</h1>
    <hr class="span-23 last">
    <div class="span-5 colborder">
        <ul>
            <li><a href="manager/reports/dayresume">Resumen de pedidos del día</a></li>
            <li><a href="manager/reports/weekresume">Resumen de pedidos de la semana</a></li>
            <li><a href="manager/reports/monthresume#">Resumen de pedidos del mes</a></li>
            <li><a href="manager/reports/daydetail#">Detalle de pedidos del día</a></li>
            <li><a href="manager/reports/clients#">Listado de clientes</a></li>
        </ul>
    </div>
    <div class="span-17 last">
        <?php if (isset($report)) $this->load->view($report) ?>
    </div>
</div>
                