<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/headNuevoUser.php';?>
<body>

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
                    <li><a href="logica/cerrarSistema.php">Cerrar Sistema</a></li>    
                </ul>
            </div>
            
            <div class="contenido">
                    <h1>Agregar Nuevo Usuario</h1>

                    <div class="formulario">
                        <form name="addForm" action="conexiones/processNuevoUsuario.php" method="POST">
                        <label>Cuenta</label>
                            <br>
                            <input type="text" name="cuenta" required placeholder="No cuenta"  
                            id="cuenta" pattern="^([0-9]){1,11}$" 
                            title="Este campo acepta números">
                            <label>Correo</label>
                            <br>
                            <input type="text" name="email" 
                            placeholder="Correo Electrónico" value="" id="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required title="Este campo requiere un correo electrónico">
                            <label>Telefono</label>
                            <br>
                            <input type="text" name="phone" placeholder="Telefono" value="" id="phone" pattern="^([0-9]){8,15}$" required title="Este campo acepta números">
                            <label>Password</label>
                            <br>
                            <input type="text" name="password" placeholder="Contraseña"  value="" id="password" pattern="^([a-zA-Z0-9]){5,20}$" required title="Este campo acepta contraseñas de 5 a 20 dígitos y debe contener ya sea letras mayúsculas, minúsculas o números únicamente">
                            <label>Password</label>
                            <br>
                            <input type="text" name="conf_password" placeholder="Confirmar Contraseña"  value="" id="conf_password" pattern="^([a-zA-Z0-9]){5,20}$" required title="Este campo acepta contraseñas de 5 a 20 dígitos y debe contener ya sea letras mayúsculas, minúsculas o números únicamente">
                            <br>
                            <button type="submit" name="agregar2">Agregar</button>
                        </form>
                    </div>
                
            </div>
        </div>
</body>
</html>