<?php
include "layouts/head.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "navbar.php"; ?>
<body>

<?php

if(empty(session_id())){
    session_start();
}
$estado = false;

$reference =  isset($_GET["reference"]) ? $_GET["reference"] : "";

if($reference){

    $reference = unserialize(base64_decode($reference));
    $error = UserController::instance()->activateAcount($reference);

    if(empty($error)){
        $estado = true;
    }
}

?>




<main class="contenido wrapper">

    <?php if($estado) : ?>

        <h1 class="text-center main-color"><i class="fas fa-user-plus fa-1x" aria-hidden="true"></i></h1>
        <h1 class="text-center main-color">Creación de usuario</h1>
        <p class="text-center main-color">Tú cuenta se ha activado exitosamente, ya puedes ingresar al sistema.</p>

        <div class="form-group">
            <a  class="btn btn-secondary btn-lg btn-block" href="usuario/login.php">Login</a>
        </div>
    <?php else :?>
        <h1 class="text-center main-color"><i class="fas fa-exclamation-triangle fa-1x" aria-hidden="true"></i></h1>
        <h1 class="text-center main-color">Lo sentimos</h1>
        <p class="text-center main-color">El enlace no es válido.</p>

        <div class="form-group">
            <a  class="btn btn-secondary btn-lg btn-block" href="usuario/login.php">Login</a>
        </div>

    <?php endif; ?>

</main>
</body>
</html>