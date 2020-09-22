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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Usuario</title>
</head>
<body>
    <div class="alert alert-success" role="alert">
    Bienvenido al portal de Usuario <?php echo $usuario?>
    </div>
    <a href="logica/cerrarSession.php" class="btn btn-primary btn-lg active btn-lg btn-block" role="button" aria-pressed="true">Cerrar Sesión</a>
</body>
</html>