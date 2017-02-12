<?php
/**
 * Página principal del administrador.
 */
if (!$this->uri->segment(4)) {
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
        font-weight: bold;
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
            location.href='../manager/reports/dayresume/'+date;
        } else {
            alert('Debes seleccionar una fecha');
        }
    }

    function showReport(format){
        var date = $("#actualDate").val();
        if (date != '') {
            location.href='../manager/reports/report/'+date+'/'+format;
        } else {
            alert('Debes seleccionar una fecha');
        }
    }
</script>

<h3>Resumen de pedidos del día <input type="text" id="datepicker" value="<?php echo $datepickernow ?>"><button class="button" id="btnShow" onclick="showByDate();">Mostrar</button></h3>
<input type="hidden" id="actualDate" value="<?php echo $datenow ?>">
<div>

    <h2>Productos pedidos</h2>

    <table border="1" cellspacing=0 cellpadding=0 width="600px">
        <tr>
            <th width="100px">
                Código
            </th>
            <th width="400px">
                Producto
            </th>
            <th width="100px">
                Cantidad
            </th>
        </tr>
        <?php foreach ($products as $product) { ?>
            <tr>
                <td width="100px">
                    <?php echo $product['id_product'] ?>
                </td>
                <td width="400px">
                    <?php echo $product['name'] ?>
                </td>
                <td width="100px">
                    <?php echo $product['cuantity'] ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
