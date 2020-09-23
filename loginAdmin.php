<!DOCTYPE html>
<html lang="en">
<?php include "layouts/headAdmin.php";?>
<body>
    <form action="logica/verificarAdmin.php" method="POST">
        <h1>Log In de Administrador</h1>
        <div class="form-group">
            <label for="">Usuario: </label>
            <input type="text" name="usuario" class="form-control" id="" placeholder="Usuario" pattern="^[A-Za-z0-9!#$%&'*+/=?^_`{|}~-]+" required title="Este campo requiere un usuario">
        </div>
        <div class="form-group">
            <label for="">Contraseña: </label>
            <input type="text" name="contrasena" placeholder="Contraseña" class="form-control" id="" pattern="[A-Za-z\s0-9\.]+" required title="Este campo solo acepta letras y números">
        </div>
        <div class="form-group">
            <input type="submit" value="Enviar" class="btn btn-secondary btn-lg btn-block">
        </div>   
    </form>
</body>
</html>