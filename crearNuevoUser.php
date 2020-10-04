<?php
include "layouts/head.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "navbar.php"; ?>
<body>

<?php

include "controllers/MailManager.php";
if(empty(session_id())){
    session_start();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $cuenta = $_POST['cuenta'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $role = 3;
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];
    $status = 1;

    if($password!=$conf_password)
    {
        $_SESSION["error"] = "Las contraseñas no coinciden.";
        header("location: ./crearNuevoUser.php");
    }


    if(!($cuenta=="" OR $email=="" OR $phone=="" OR $name=="" OR $password=="" OR $conf_password=="")){

        $error = UserController::instance()->crearCuentayUsuario($cuenta, $email, $name, $role,$phone,$password,$status);

        if(empty($error)){
            MailManager::instance()->sendWelcomeMail($email, $name);

            $_SESSION["success"] = "Se ha creado su usuario, revise su correo electrónico se le ha enviado un enlace para activar tu cuenta.";
            header("location: ./crearNuevoUser.php");
        }else{
            $_SESSION["error"] = $error;
            header("location: ./crearNuevoUser.php");
        }

    }else{
        $_SESSION["error"] = "Por favor envie todos los datos requeridos.";
        header("location: ./crearNuevoUser.php");
    }

    die();
}
?>




<main class="contenido wrapper">
    <h1 class="text-center main-color"><i class="fas fa-user-plus fa-1x" aria-hidden="true"></i></h1>
    <h1 class="text-center main-color">Creación de usuario</h1>
    <p class="text-center main-color">Bienvenido, puedes crear tu usuario solamente necesitas el número de cuenta que no este asocioado a ninguna otro usuario.</p>

    <?php include "layouts/errors.php"; ?>
    <form action="crearNuevoUser.php" method="POST" autocomplete="off">
        <div class="form-group">
            <label for="">Número de cuenta: </label>
            <input  class="form-control" type="text" name="cuenta" required placeholder="No cuenta" id="cuenta" pattern="^([0-9]){1,11}$" maxlength="11" title="Este campo acepta números">
        </div>

        <div class="form-group">
            <label for="">Correo: </label>
            <input  class="form-control" type="text" name="email" placeholder="Correo Electrónico" value="" id="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required title="Este campo requiere un correo electrónico" maxlength="50">
        </div>
        <div class="form-group">
            <label for="">Nombre: </label>
            <input  class="form-control" type="text" name="name" placeholder="Nombre" value="" id="email"  pattern="^[a-zA-Z0-9  ]+$" title="Ingrese solamente con caractéres alfanúmericos." required maxlength="50">
        </div>
        <div class="form-group">
            <label for="">Telefono: </label>
            <input  class="form-control" type="text" name="phone" placeholder="Telefono" value="" id="phone" pattern="^([0-9]){8,15}$" required title="Este campo acepta números" maxlength="15">
        </div>
        <div class="form-group">
            <label for="">Contraseña: </label>
            <input  class="form-control" type="password" name="password" placeholder="Contraseña"  value="" id="password" pattern="^([a-zA-Z0-9]){5,20}$" required title="Este campo acepta contraseñas de 5 a 20 dígitos y debe contener ya sea letras mayúsculas, minúsculas o números únicamente" maxlength="20">
        </div>
        <div class="form-group">
            <label for="">Confirmar Contraseña: </label>
            <input class="form-control"  type="password" name="conf_password" placeholder="Confirmar Contraseña"  value="" id="conf_password" pattern="^([a-zA-Z0-9]){5,20}$" required title="Este campo acepta contraseñas de 5 a 20 dígitos y debe contener ya sea letras mayúsculas, minúsculas o números únicamente" maxlength="20">
        </div>

        <div class="form-group">
            <input type="submit" value="Agregar" class="btn btn-main btn-lg btn-block">
        </div>
    </form>
</main>
</body>
</html>