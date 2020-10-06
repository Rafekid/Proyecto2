<?php  
include "../models/Transaccion.php";
include "../models/User.php";
include "../controllers/UserController.php";
include "../controllers/DBTransactions.php";
include "../helpers/AuthRedirectUser.php";

$message =  isset($_SESSION["error"]) ? $_SESSION["error"] : "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST["usuario"] && $_POST["contrasena"]) {
        $logued = UserController::instance()->login($_POST["usuario"], $_POST["contrasena"]);
        if ($logued) {
            header("location: ./index.php");
        } else {
            $_SESSION["error"] = "Lo sentimos los datos que ingreso no se encuentran en nuestros registros.";
            header("location: ./login.php");
        }
    }
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/cajero.css">
        <script src="http://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
        <title>Usuario</title>
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    <div class="login_container">
        <form action="login.php" method="POST">
            <h1>Log In Usuario</h1>
            <br>
            <?php if ($message) : ?>
                <p class="error"><?= $message ?></p>
            <?php endif ?>

            <div class="form-group">
                <label for="">Usuario: </label>
                <input type="text" name="usuario" class="form-control" id="" placeholder="Email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required title="Este campo requiere un correo electrónico">
            </div>
            <div class="form-group">
                <label for="">Contraseña: </label>
                <input type="password" name="contrasena" placeholder="Contraseña" class="form-control" id="" pattern="[A-Za-z\s0-9\.]+" required title="Este campo solo acepta letras y números">
            </div>
            <div class="form-group">
                <input type="submit" value="Enviar" class="btn btn-secondary btn-lg btn-block">
            </div>
        </form>
    </div>
</body>

</html>