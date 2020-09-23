<?php

    session_start();

    $usuario = $_SESSION['username'];

    /*Aqui restringimos el acceso, si aún no se han logueado y matamos la session*/
    if(!$usuario){
        header("location: loginAdmin.php");
        die();
    } 

?>

<!DOCTYPE html>
<html lang="en">
<?php include "layouts/headAdmin.php";?>
<body>
    <?php 
        include 'conexiones/conexion.php';
        $sql="SELECT id_cajero,nom_comp,usuario,bloqueo FROM cajeros";
        $resultado=mysqli_query($conexion,$sql) or die(mysql_error());
    ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>USUARIO</th>
                <th>BLOQUEO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while($filas = mysqli_fetch_assoc($resultado)) {

            ?>
            <tr>
                <td><?php echo $filas['id_cajero']?></td>
                <td><?php echo $filas['nom_comp']?></td>
                <td><?php echo $filas['usuario']?></td>
                <td><?php echo $filas['bloqueo']?></td>
                <td>
                <a href="id=<?php echo $filas['id_cajero']?>">Bloquear</a>
                <a href="">Desbloquear</a>
                </td>
            </tr>
            <?php 
                    }
            
            $sql = null;
            $conexion = null;?>
        </tbody>
    </table>
</body>
</html>