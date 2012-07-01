<?php
/**
 * Página principal del administrador.
 * 
 * @author Carlos Bello
 */
if ($this->uri->segment(4) === FALSE) {
    $datenow = date("Y-m-d");
    $datepickernow = date("d/m/Y");
} else {
    $datenow = $this->uri->segment(4);
    $temp = explode('-', $datenow);
    $datepickernow = $temp[2].'/'.$temp[1].'/'.$temp[0];
}
?>
<style>
    #btnShow {
        font-size: 11px;
    }
</style>
<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            autoSize: true,
            altField: "#actualDate",
            altFormat: "yy-mm-dd",
            dateFormat: "dd/mm/yy"
        });
    });
    
    function showByDate(){
        var date = $("#actualDate").val();
        if (date != '') {
            location.href='../manager/reports/daydetail/'+date;
        } else {
            alert('Debes seleccionar una fecha'); 
        }
    }      
</script>
<h3>Detalles de pedidos del día <?php //echo date("d-m-Y\n"); ?> <input type="text" id="datepicker" value="<?php echo $datepickernow ?>"><button class="button" id="btnShow" onclick="showByDate();">Mostrar</button></h3>
<input type="hidden" id="actualDate" value="<?php echo $datenow ?>">

<div >

    <table border="1" cellspacing="0" cellpadding="0" width="600px">
        <?php
        $orden = '';
        foreach ($details as $detail) {
            $ordenant = $orden;
            $orden = $detail['id'];
            ?>
            <?php
            if ($ordenant != $orden) {
                ?>          
                <tr > 
                    <td width="40px"><strong>Pedido: <?php echo $detail['id']; ?></strong></td> 
                    <td width="400px">
                        <?php echo ' <b>Usuario:</b> ' . $detail['id_user'] . ' ' . $detail['user_name'] . ' <b>Dirección: </b>' . $detail['address'] . ' <b>Teléf:</b> ' . $detail['phone'] ?>
                    </td>
                    <td width="160px">
                        <?php echo '<b>Comentario:</b> ' . $detail['comments'] . ' <b>Pagado:</b> ' . ($detail['payment'] == '1' ? 'SI' : 'NO') ?> 
                    </td>
                </tr>         
                <?php
            }
            ?> 
            <tr>
                <td width="40px"></td> 
                <td colspan="2">
                    <?php echo $detail['product_name'] //' Producto: ' . $detail['id_product'] . ' ' . ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
