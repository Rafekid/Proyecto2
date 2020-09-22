<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Administrador</title>
</head>
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