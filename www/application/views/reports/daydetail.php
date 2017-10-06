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
        if (date !== '') {
            location.href='../manager/reports/daydetail/'+date;
        } else {
            alert('Debes seleccionar una fecha');
        }
    }
</script>
<h3 class="row">
    <div class="col-sm-6">Detalles de pedidos del día</div>
    <div class="col-sm-3">
        <input type="text" id="datepicker" value="<?php echo $datepickernow ?>" class="form-control">
    </div>
    <div class="col-sm-3">
        <button class="btn btn-primary form-control" id="btnShow" onclick="showByDate();">Mostrar</button>
    </div>
</h3>
<input type="hidden" id="actualDate" value="<?php echo $datenow ?>">

<div>
    <?php
    $orden = '';
    $count = 1;
    foreach ($details as $detail) {
        $ordenant = $orden;
        $orden = $detail['id_order'];
        ?>
        <?php
        if ($ordenant != $orden) {
            if (!empty($ordenant)) {
                ?>
            </div>
                <?php
            }
            ?>
            <div class="col-sm-6 <?php echo $count % 2 == 0 ? 'last' : 'colborder' ?>">
                <strong># <?php echo $detail['id_order']; ?>
                    <?php echo $detail['user_name'] ?>
                </strong> <br>
                <address><?php echo $detail['address']." (Tlf: ".$detail['phone'].")" ?> </address><br>
                <cite><?php echo $detail['order_comments'] ?></cite>
            <?php
        }
        ?>
            <?php echo $detail['product_name'].', ' ?>
    <?php
        $count++;
    } ?>
    <?php if ($count > 1) { ?>
        </div>
    <?php } ?>
</div>
