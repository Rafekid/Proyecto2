<!DOCTYPE html>
<html lang="en">
<?php


$section  = "deposit";
include "../layouts/header_cajero_in.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["account"]) && !empty($_POST["account"]) && isset($_POST["amount"]) && !empty($_POST["amount"])){
        $error = CajeroController::instance()->deposit($_POST["account"],$_POST["amount"]);
        if(empty($error)){
            $_SESSION["success"] = "Se ha realizado el depósito a la cuenta ".$_POST["account"];
            header("location: ./deposit.php");
        }else{
            $_SESSION["error"] = $error;
            header("location: ./deposit.php");
        }

    }else{
        $_SESSION["error"] = "Por favor envie todos los datos requeridos.";
        header("location: ./deposit.php");
    }

    die();
}
?>

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