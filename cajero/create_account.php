<?php
$section  = "create";
include "../layouts/header_cajero_in.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["account"]) && !empty($_POST["account"]) && isset($_POST["dpi"]) && !empty($_POST["dpi"]) && isset($_POST["amount"]) && !empty($_POST["amount"])) {

        $cuentaID = CajeroController::instance()->createAccount($_POST["account"], $_POST["dpi"], $_POST["amount"]);
        if ($cuentaID) {
            $_SESSION["success"] = "La cuenta se ha registrado correctamente el número es $cuentaID.";
            header("location: ./create_account.php");
        } else {
            $_SESSION["error"] = "Lo sentimos la cuenta no se ha registrado intentalo nuevamente.";
            header("location: ./create_account.php");
        }
    } else {
        $_SESSION["error"] = "Por favor envie todos los datos requeridos.";
        header("location: ./create_account.php");
    }

    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/cajero.css">
    <script src="https://kit.fontawesome.com/3152c32f70.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <title>Cajero</title>
</head>

<header>
    <section class="wrapper">
        <nav>
            <ul>

                <li><a href="./index.php"><img src="/bancaUMG/imagenes/logo.png" alt="" height="24"></a></li>
                <li class="<?php if ($section == "create") echo "active"; ?>"><a href="./create_account.php">Creación Cuenta</a></li>
                <li class="<?php if ($section == "deposit") echo "active"; ?>"><a href="./deposit.php">Depósito</a></li>
                <li class="<?php if ($section == "retirement") echo "active"; ?>"><a href="./retirement.php">Retiro</a></li>
                <li class="right"><a href="./logout.php"><i class="fas fa-power-off" aria-hidden="true"></i></a></a></li>
            </ul>
        </nav>
    </section>
</header>

<body>
    <div class="login_container">
        <h1 class="text-center main-color"><i class="fas fa-user-plus fa-1x" aria-hidden="true"></i></h1>
        <h1 class="text-center main-color">Crear cuenta monetaria </h1>
        <p class="text-center main-color">En esta sección puedes crear cuentas de monetarias de usuarios del banco, ingresa los valores que se solicitan para crear una cuenta.</p>


        <?php include "../layouts/errors.php"; ?>
        <form action="create_account.php" method="POST" autocomplete="off">
            <div class="form-group">
                <label for="">Nombre de la cuenta: </label>
                <input type="text" name="account" class="form-control" id="" placeholder="Nombre de la cuenta" pattern="^[a-zA-Z0-9  ]+$" required title="Ingrese solamente con caractéres alfanúmericos." maxlength="50">
            </div>

            <div class="form-group">
                <label for="">DPI: </label>
                <input type="text" name="dpi" class="form-control" id="" placeholder="DPI" pattern="^[0-9]{16,}" required title="Ingrese un valor válido de 16 diitos." maxlength="16" minlength="16">
            </div>

            <div class="form-group">
                <label for="">Monto inicial: </label>
                <input type="text" name="amount" class="form-control" id="" placeholder="Nombre de la cuenta" pattern="^(\d*\.)?\d+$" required title="Ingrese un valor válido.">
            </div>

            <div class="form-group">
                <input type="submit" value="Enviar" class="btn btn-main btn-lg btn-block">
            </div>
        </form>

    </div>
</body>
</html>