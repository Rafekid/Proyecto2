<?php
include "../layouts/headUsuario.php"; ?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../css/form.css">
<?php include "navbar.php"; 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST["cuenta"] && $_POST["maximo"] && $_POST["cantidad"] && $_POST["alias"]) {
        $user = $_SESSION[$session_name];
        $cuenta = new CuentaTercera(0, $user->idUser, $_POST["cuenta"], $_POST["maximo"], $_POST["cantidad"], $_POST["alias"], 1);
        switch (UserController::instance()->crearcuentaTerceros($cuenta)) {
            case 1:
                header("location: ./index.php"); 
                break;
            case 2: ?>
                <h4 class="error"> <a href="./index.php"> No puedes agregar una cuenta propia. <strong>#<?= $_POST["cuenta"] ?></strong></a></h4>
                <?php
                break;
            case 3: ?>
                <h4 class="error"><a href="./index.php">Ya has agregado esta cuenta. <strong>#<?= $_POST["cuenta"]?></strong></a></h4>
                <?php
                break;
            case 4:?>
                <h4 class="error"><a href="./index.php">No se ha encontrado la cuenta. <strong>#<?= $_POST["cuenta"]?></strong></a></h4>
                <?php
                break;
            default:
                header("location: ./index.php"); 
                break;
        }
    }
}

?>
<body>
    <div class="main">
        <form action="./agregarCuentaTercero.php" method="post">
            <div class="form">
                <br>
                <label for="cuenta">No. Cuenta</label>
                <input type="number" class="form-control" name="cuenta" id="cuenta" placeholder="Número de Cuenta" required>
            </div>

            <div class="form">
                <label for="maximo">Monto Máximo</label>
                <input type="number" class="form-control" name="maximo" id="maximo" placeholder="Monto Máximo de transferencia" required>
            </div>

            <div class="form">
                <label for="cantidad">Cantidad Máxima</label>
                <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad Máxima de transacciones" required>
            </div>

            <div class="form">
                <label for="alias">Alias</label>
                <input type="text" class="form-control" name="alias" id="alias" placeholder="Alias de la cuenta" required>
            </div>

            <div class="form">
                <button type="submit">Enviar</button>
            </div> 
        </form>
    </div>
</body>
</html>