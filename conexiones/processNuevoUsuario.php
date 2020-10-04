<?php  
    include "conexion.php";

    if(isset($_POST['agregar2'])){
        $cuenta = $_POST['cuenta'];
        $email = $_POST['email'];
        $role = 3;
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $conf_password = $_POST['conf_password'];
        $status = 1;
        
        if($cuenta=="" OR $email=="" OR $phone=="" OR $password=="" OR $conf_password==""){

            $mensaje = 'No pueden existir campos nulos!';

        }elseif($password!=$conf_password)
        {

            $mensaje = 'las contrasenas no coinciden!';
        }else{
            
            $mensaje = 'Se agrego nuevo usuario!';
            
            $q2 = "call create_user('$email','null','$role','$phone','$password','$status')";

            $consulta = mysqli_query($conexion,$q2) or die(mysql_error());
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<!-- Se coloca el head a parte para no crear conflicto con el link al css -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Si se le quita el ../ en el link del styleshet ya no agrarra el css -->
        <link rel="stylesheet" href="../css/estyleAdmin.css">
        <title>Nuevo Usuario</title>
</head>
<body>
        <div class="contenedor">

            <div class="sidebar">
                <h2>MENÚ</h2>
                <ul>
                    <li><a href="../crearNuevoUser.php">Regresar a Crear Nuevo Usuario</a></li> 
                    <li><a href="../logica/cerrarSistema.php">Cerrar Sistema</a></li>    
                </ul>
            </div>
           
            <div class="contenido">

                    <h2><?php echo $mensaje;?></h2>     
            </div>
        </div>
</body>
</html>





