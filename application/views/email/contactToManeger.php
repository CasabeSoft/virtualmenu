<html>
    <body>
        <h2>Datos de contacto del cliente:</h2>
        <p><b>Nombre y apellidos: </b><?php echo $userName; ?></p>
        <p><b>Correo electrónico: </b><?php echo $userEmail; ?></p>
        <p><b>Teléfono: </b><?php echo $userPhone; ?></p>
        <p><b>Mensaje: </b></p>
        <p><?php echo $userMessage; ?></p>       
        <br>
        <p>Mensaje enviado desde <?php echo base_url(); ?> el <?php echo date('d/m/Y, H:i:s', time()); ?></p>
    </body>
</html>