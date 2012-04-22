<?php
/**
 * Listado de usuarios.
 * 
 * @author Leoanrdo Quintero
 */
?>

            <div id="content">
                <h1 class="title">Usuarios</h1>
                <table border='1'>
                    <?php foreach ($users as $user): ?>

                        <tr>
                            <td><?php echo $user['name'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['password'] ?></td>
                        </tr>
                    <?php endforeach ?>
                        
                </table>            
            </div>
