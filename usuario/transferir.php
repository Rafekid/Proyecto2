<?php
include "../layouts/headUsuario.php"; ?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../css/form.css">
<?php include "navbar.php"; 
$user = $_SESSION[$session_name]; 
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST["own_cuenta"] && $_POST["third_cuenta"] && $_POST["monto"]) {
        switch (UserController::instance()->transferir($user->idUser, $_POST["own_cuenta"], $_POST["third_cuenta"], $_POST["monto"])) {
            case 1:
                header("location: ./index.php"); 
                break;
            case 2: ?>
                <h4 class="error"> <a href="./index.php"> Ya supero el número de transferencias permitidas</a></h4>
                <?php
                break;
            case 3: ?>
                <h4 class="error"><a href="./index.php"> Debe ingresar un monto menor al máximo permitido</a></h4>
                <?php
                break;
            case 4:?>
                <h4 class="error"><a href="./index.php">Ya no tiene suficiente crédito para la transferencia</a></h4>
                <?php
                break;
            default:
                header("location: ./index.php"); 
                break;
        }
    }
}

$cuentas = UserController::instance()->cuentas($user->idUser);
$cuentaTerceros = UserController::instance()->cuentasTerceros($user->idUser);?>

<body>
    <div class="main">
        <form action="./transferir.php" method="post">
            <div class="form">
                <br>
                <label for="own_cuenta">Cuenta</label>
                <select class="form-control" name="own_cuenta" id="own_cuenta" required>
                    <?php 
                    if (count($cuentas) > 0) :
                        foreach ($cuentas as $key => $value) : ?>
                            <div class="transactions">
                                <option value="<?= $value->idAccount ?>"><?= $value->name ?></option>
                            </div>
                        <?php       
                        endforeach; 
                    endif; ?> 
                </select>
            </div> 

            <div class="form">
                <label for="third_cuenta">Cuenta a transferir</label>
                <select class="form-control" name="third_cuenta" id="third_cuenta" required>
                    <?php 
                    if (count($cuentaTerceros) > 0) :
                        foreach ($cuentaTerceros as $key => $value) : ?>
                            <div class="transactions">
                                <option value="<?= $value->idAccount ?>"><?= $value->alias ?></option>
                            </div>
                        <?php       
                        endforeach; 
                    endif; ?> 
                </select>
            </div> 

            <div class="form">
                <label for="monto">Monto </label>
                <input type="number" class="form-control" name="monto" id="monto" placeholder="Monto a transferir" required>
            </div>

            <div class="form">
                <button type="submit">Enviar</button>
            </div> 
        </form>
    </div>
</body>
</html>