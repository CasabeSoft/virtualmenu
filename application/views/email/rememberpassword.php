<html>
    <body>
        <h2>Restablecer contraseña para <?php echo $userName; ?></h2>
        <p>Por favor, haga clic en este enlace para <?php echo anchor('resetPassword/' . $passwordCode, 'restablecer su contraseña'); ?>.</p>
        <p><?php echo site_url('resetPassword/' . $passwordCode) ?></p>
        <br>
        <p>Mensaje enviado desde <?php echo base_url(); ?> el <?php echo date('d/m/Y, H:i:s', time()); ?></p>
    </body>
</html>