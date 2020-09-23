<?php

    session_start();

    $usuario = $_SESSION['username'];

    /*Aqui restringimos el acceso, si aún no se han logueado y matamos la session*/
    if(!$usuario){
        header("location: loginUsuario.php");
        die();
    } 

?>

<!DOCTYPE html>
<html lang="en">
<?php include "layouts/headUsuario.php";?>
<body>
    <div class="alert alert-success" role="alert">
    Bienvenido al portal de Usuario <?php echo $usuario?>
    </div>
    <a href="logica/cerrarSession.php" class="btn btn-primary btn-lg active btn-lg btn-block" role="button" aria-pressed="true">Cerrar Sesión</a>
</body>
</html>