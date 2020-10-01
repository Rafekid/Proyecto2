<?php

    session_start();
    echo $_SESSION['username'];
    $usuario2 = $_SESSION['username'];

    /*Aqui restringimos el acceso, si aún no se han logueado y matamos la session*/
    if(!$usuario2){
        header("location: loginAdmin.php");
        die();
    } 

?>

<!DOCTYPE html>
<html lang="en">
<?php include "layouts/headAdmin.php";?>
<body>
    <div class="alert alert-success" role="alert">
    Bienvenido al portal de Administrador <?php echo $usuario2?></div>
    <?php
        if(isset($_SESSION['message'])):
    ?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">   
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>

    <?php endif ?>  
    
        <div class="contenedor">

            <div class="sidebar">
                <h2>MENÚ</h2>
                <ul>
                    <li><a href="adminPanel.php">Panel Administrador</a></li>
                    <li><a href="logica/cerrarSessionAdmin.php">Cerrar Sesión</a></li>
                    <li><a href="logica/cerrarSistema.php">Cerrar Sistema</a></li>    
                </ul>
            </div>
            
            <div class="contenido">
                    <h1>Agregar Cajeros</h1>

                    <div class="formulario">
                        <form name="addForm" action="conexiones/processListaCajeros.php" method="POST">
                            <label>Usuario</label>
                            <br>
                            <input type="text" name="email" 
                            placeholder="Correo Electrónico" value="" id="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required title="Este campo requiere un correo electrónico">
                            <label>Telefono</label>
                            <br>
                            <input type="text" name="phone" placeholder="Telefono" value="" id="phone" pattern="^([0-9]){8,15}$" require title="Este campo acepta números">
                            <label>Password</label>
                            <br>
                            <input type="text" name="password" placeholder="Contraseña"  value="" id="password" pattern="^([a-zA-Z0-9]){5,20}$" require title="Este campo acepta contraseñas de 5 a 20 dígitos y debe contener ya sea letras mayúsculas, minúsculas o números únicamente">
                            <label>Password</label>
                            <br>
                            <input type="text" name="conf_password" placeholder="Confirmar Contraseña"  value="" id="conf_password" pattern="^([a-zA-Z0-9]){5,20}$" require title="Este campo acepta contraseñas de 5 a 20 dígitos y debe contener ya sea letras mayúsculas, minúsculas o números únicamente">
                            <!-- <label>Estado</label>
                            <br>
                            <input type="text" name="status" placeholder="Estado" value=""> -->
                            <label>Nombre Completo</label>
                            <br>
                            <input type="text" name="name" placeholder="Nombre Completo" value="" id="name"
                            pattern="^([a-zA-Z\s])*$" require title="Este campo acepta letras únicamente">
                            <br>
                            <button type="submit" name="agregar">Agregar</button>
                        </form>
                    </div>
                
            </div>
        </div>
</body>
</html>