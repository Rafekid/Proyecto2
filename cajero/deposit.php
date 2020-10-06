<?php

$section  = "deposit";
include "../layouts/header_cajero_in.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["account"]) && !empty($_POST["account"]) && isset($_POST["amount"]) && !empty($_POST["amount"])) {
        $error = CajeroController::instance()->deposit($_POST["account"], $_POST["amount"]);
        if (empty($error)) {
            $_SESSION["success"] = "Se ha realizado el depósito a la cuenta " . $_POST["account"];
            header("location: ./deposit.php");
        } else {
            $_SESSION["error"] = $error;
            header("location: ./deposit.php");
        }
    } else {
        $_SESSION["error"] = "Por favor envie todos los datos requeridos.";
        header("location: ./deposit.php");
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
        <h1 class="text-center main-color"><i class="fas fa-money-bill-alt fa-1x" aria-hidden="true"></i></h1>
        <h1 class="text-center main-color">Depósito Monetario </h1>
        <p class="text-center main-color">En esta sección puedes realizar un deposito monetario a una cuenta existente.</p>

        <?php include "../layouts/errors.php"; ?>

        <form action="deposit.php" method="POST" autocomplete="off">
            <div class="form-group">
                <label for="">Número de cuenta: </label>
                <input type="text" name="account" class="form-control" placeholder="Número de cuenta" pattern="^(\d)+$" required title="Ingrese solamente carácteres numericos" maxlength="11">
            </div>

            <div class="form-group">
                <label for="">Monto a depositar: </label>
                <input type="text" name="amount" class="form-control" placeholder="Monto a depositar" pattern="^(\d*\.)?\d+$" required title="Ingrese un valor decimal válido.">
            </div>

            <div class="form-group">
                <input type="submit" value="Enviar" class="btn btn-main btn-lg btn-block">
            </div>
        </form>

    </div>
</body>

</html>