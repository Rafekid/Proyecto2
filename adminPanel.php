<?php

    session_start();
    echo $_SESSION['username'];
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
    <div class="alert alert-success" role="alert">
    Bienvenido al portal de Administrador <?php echo $usuario?>
    </div>
        <div class="contenedor">
            <div class="sidebar">
                <h2>MENÚ</h2>
                    <ul>
                    <li><a href="agregarCajeros.php">Agregar Cajeros</a></li>
                    <li><a href="bloqueoCajeros.php">Bloquear Cajeros</a></li>
                    <li><a href="monitoreo1.php">Transferencias Diarias</a></li>
                    <li><a href="monitoreo2.php">Transacciones X Usuario</a></li>
                    <li><a href="monitoreo3.php">Monto Acumulado</a></li>
                    <li><a href="logica/cerrarSessionAdmin.php">Cerrar Sesión</a></li>
                    <li><a href="logica/cerrarSistema.php">Cerrar Sistema</a></li>    
                    </ul>
            </div>
            <div class="contenido">
                <h2>En este panel se pueden realizar las siguientes tareas: </h2>
                <dl>
                    <dt>Gestión de usuarios de Cajeros</dt>
                        <dd>- Listado de cajeros.</dd>
                        <dd>- Bloquear y desbloquear usuarios de cajeros.</dd>
                        <dd>- Agregar nuevo usuario cajero</dd>
                    <dt>Monitor de transferencias</dt>
                        <dd>- Cantidad de transacciones realizadas en el día.</dd>
                        <dd>- Cantidad de usuarios que han realizado transacciones.</dd>
                        <dd>- Monto acumulado de transacciones en el día.</dd>
                    <dt>Salir</dt>
                        <dd>- Cerrar sesión</dd>
                        <dd>- Salir del sistema</dd>
                </dl>
            </div>
    </div>
</body>
</html>