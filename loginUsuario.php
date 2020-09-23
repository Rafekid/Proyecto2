<!DOCTYPE html>
<html lang="en">
<?php include "layouts/headUSuario.php";?>
<body>
    <form action="logica/verificarUsuario.php" method="POST">
        <h1>Log In de Uasuario</h1>
        <div class="form-group">
            <label for="">Usuario: </label>
            <input type="email" name="usuario" class="form-control" id="" placeholder="Usuario" pattern="^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$" required title="Este campo requiere un correo electrónico">
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