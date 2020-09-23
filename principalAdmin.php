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
    <div class="alert alert-success" role="alert">
    Bienvenido al portal de Administrador <?php echo $usuario?>
    </div>
    <div class="sidebar">
        <h2>MENÚ</h2>
        <ul>
        <li><a href="listaCajeros.php">Listado Cajeros</a></li>
        <li><a href="">Agregar Cajeros</a></li>
        <li><a href="logica/cerrarSessionAdmin.php">Cerrar Sesión</a></li>   
        </ul>
    </div>
    <div class="contenido">
        <img class="menu-bar"src="imagenes/sidebar.png" alt="sidebar" width="45" height="45">
    </div>
    <script src="js/abrir.js"></script>
</body>
</html>