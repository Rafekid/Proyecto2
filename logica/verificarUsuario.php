<?php
    require '../conexiones/conexion.php';
    /* En cada archivo donde trabajemos con sesiones debemos de colocar la variable de session_start */

    session_start();

    /* Primero verificamos si traemos algo del formulario que esta en el loginUsuario sino trae nada que se salga y que lo reenvie a dicho formulario */
    if(isset($_POST)){
        header("location: ../loginUsuario.php");
    }

    $usuario = $_POST['usuario'];
    $contrasena= $_POST['contrasena'];

    /* Aqui validamos en la db que exista el usuario y contraseña */
    $q = "SELECT COUNT(*) as contar from usuarios where correo = '$usuario' AND clave = '$contrasena'";

    $consulta = mysqli_query($conexion,$q) or die(mysql_error());
    $array = mysqli_fetch_array($consulta);

    if($array['contar']>0){
        $_SESSION['username'] = $usuario;
        header("location: ../principalUsuario.php");
    }else{
        echo'<script language="javascript">
            window.location.href="../loginUsuario.php";
            alert("Error en usuario o contraseña"); 
            </script>'; 
    }

    $conexion->close();
    
?>
