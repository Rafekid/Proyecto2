<!DOCTYPE html>
<html lang="en">
<?php include "../layouts/header_usuario_out.php";
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
}
?>

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