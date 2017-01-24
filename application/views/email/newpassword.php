<html>
    <body>
        <h2>Nueva contraseña para <?php echo $userName; ?></h2>
        <p>Su contraseña se ha restablecido a: <?php echo $newPassword; ?></p>
        <br>
        <p>Mensaje enviado desde <?php echo base_url(); ?> el <?php echo date('d/m/Y, H:i:s', time()); ?></p>
    </body>
</html>