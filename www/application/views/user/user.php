<?php
/**
 * Listado de usuarios.
 *
 * @author Leoanrdo Quintero
 */
?>

                <h1 class="title">Usuarios</h1>
                <div style='height:10px;'></div>  
                
                <table border='1'>
                    <?php foreach ($users as $user): ?>

                        <tr>
                            <td><?php echo $user['name'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['password'] ?></td>
                        </tr>
                    <?php endforeach ?>
                        
                </table>           
