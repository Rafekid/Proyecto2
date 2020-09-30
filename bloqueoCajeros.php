<?php

    session_start();
    echo $_SESSION['username'];
    $usuario2 = $_SESSION['username'];

    /*Aqui restringimos el acceso, si aún no se han logueado y matamos la session*/
    if(!$usuario2){
        header("location: loginAdmin.php");
        die();
    } 
            $id = 0;
            $update = false;
            /* $email2 = " ";
            $role2 = " ";
            $phone2 = " ";
            $password2 = " "; */
            $status2 = " ";
            /* $name2 = " "; */

    if(isset($_GET['editar'])){
        $id=$_GET['editar'];
        $update=true;
        include "conexiones/conexion.php";
        $result = $conexion->query("SELECT * FROM user WHERE id_user=$id") or die($conexion->error());
        if(count($result)==1){
            $row = $result->fetch_array();
            /* $email2 = $row['email'];
            $role2 = $row['role'];
            $phone2 = $row['phone'];
            $password2 = $row['password']; */
            $status2 = $row['status'];
            /* $name2 = $row['name']; */
        }
        $conexion->close();
    }

?>

<!DOCTYPE html>
<html lang="en">
<?php include "layouts/headAdmin.php";?>
<body>
    <?php require "conexiones/conexion.php"?>

    <div class="alert alert-success" role="alert">
    Bienvenido al portal de Administrador <?php echo $usuario2?>
    </div>
        <?php
                if(isset($_SESSION['message'])):
            ?>

            <div class="alert alert-<?=$_SESSION['msg_type']?>">
            
                    <?php 
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    ?>
            </div>
        <?php endif ?>  
    
        <div class="contenedor">

            <div class="sidebar">
                <h2>MENÚ</h2>
                <ul>
                    <li><a href="adminPanel.php">Panel Administrador</a></li>
                    <li><a href="logica/cerrarSessionAdmin.php">Cerrar Sesión</a></li>
                    <li><a href="logica/cerrarSistema.php">Cerrar Sistema</a></li>    
                </ul>
            </div>

            <div class="contenido">
                <div>
                    <?php 
                        $result = $conexion->query("SELECT * FROM user WHERE role = 2") or die($conexion->error);
                    ?>
                    <?php
                        function pre_r($array){
                        echo '<pre>';
                        print_r($array);
                        echo '</pre>';
                        }
                    ?>
                    <h1>Listado de Cajeros</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Telefono</th>
                                <th>Estado</th>
                                <th>Nombre</th>
                                <th colspan="2">Acción</th>
                            </tr>
                        </thead>
                     <?php 
                        while($row = $result->fetch_assoc()):?>
                            <tr>
                                <td><?php echo $row['id_user']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['role']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>
                                <a href="bloqueoCajeros.php?editar=<?php echo $row['id_user']; ?>" >Seleccionar</a>
                                </td>
                            </tr>
                    <?php endwhile; ?>
                    </table>
            
                </div>

                <div>
                    <h1>Bloqueo de Cajeros</h1>

                    <div class="formulario">

                        <form action="conexiones/processListaCajeros.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <!-- <label>Correo</label>
                            <input type="text" name="email" placeholder="Correo" value="<?php
                            echo $email2;?>">
                            <label>Rol</label>
                            <input type="text" name="role" placeholder="Rol" value="<?php
                            echo $role2;?>">
                            <label>Telefono</label>
                            <input type="text" name="phone" placeholder="Tel" value="<?php
                            echo $phone2;?>">
                            <label>Password</label>
                            <input type="text" name="password" placeholder="Password" value="<?php echo $password2;?>"> -->
                            <label>Estado</label>
                            <br>
                            <input type="text" name="status" placeholder="Estado" value="<?php
                            echo $status2;?>">
                            <label>0 para bloquer 1 para desbloquear</label><br>
                            <!-- <label>Nombre Completo</label>
                            <input type="text" name="name" placeholder="Nombre" value="<?php
                            echo $name2;?>"> -->
                        <?php 
                        if($update == true): 
                        ?>
                            <button type="submit" name="editarInactivos">Confirmar</button>
                        <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>