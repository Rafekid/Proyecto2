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
    <?php require_once "conexiones/conexion.php"?>
    <div class="alert alert-success" role="alert">
    Bienvenido al portal de Administrador <?php echo $usuario?>
    </div>
    <div class="sidebar">
        <h2>MENÚ</h2>
        <ul>
        <li><a href="principalAdmin.php">Panel Administrador</a></li>
        <li><a href="">Agregar Cajeros</a></li>
        <li><a href="logica/cerrarSessionAdmin.php">Cerrar Sesión</a></li>   
        </ul>
    </div>
    <div class="contenido">
        <img class="menu-bar"src="imagenes/sidebar.png" alt="sidebar" width="45" height="45">
        <div>
           <form action="conexiones/processListaCajeros.php" method="POST">
            <label>Correo</label>
            <input type="text" name="email" value="Correo">
            <label>Rol</label>
            <input type="text" name="role" value="Rol">
            <label>Telefono</label>
            <input type="text" name="phone" value="Tel">
            <label>Password</label>
            <input type="text" name="password" value="Password">
            <label>Estado</label>
            <input type="text" name="status" value="Estado">
            <label>Nombre Completo</label>
            <input type="text" name="name" value="Nombre">
            <button type="submit" name="confirmar">Confirmar</button>
            </form>
        </div>
    </div>
    <script src="js/abrir.js"></script>
</body>
</html>