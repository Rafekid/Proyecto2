<!DOCTYPE html>
<html lang="en">
<?php include "../layouts/headUsuario.php";
include "../navbar.php";
$user = $_SESSION[$session_name]; ?>

<body>
    <div class="contenido wrapper">
        <h1>Bienvenido <?= $user->name ?></h1>
        <div id="contenedor" class="clearfix">
        
            <div id="principal">
                <h1>Transacciones</h1>
                <?php 
                $transacciones = UserController::instance()->transacciones( $user->idUser);
                if (count($transacciones) > 0) :
                    foreach ($transacciones as $key => $value) : ?>
                        <div class="transactions">
                            <h4><?= $value->type == 1 ? "Débito" : "Crédito"?></h4>
                            <h6><?= $value->monto ?></h6>
                            <h6><?= $value->fecha ?></h6>
                        </div>
                    <?php       
                    endforeach; 
                endif; ?> 
                 
            </div>

            <div id="lateral">
                <h1 id="text-terceros">Cuentas de terceros</h1>
                <br>
                <a id="agregar" href="agregarCuentaTercero.php">Agregar Nueva</a>  <a id="agregar" href="transferir.php">Transferir</a>
                <br>
                <br>
                <?php 
                $cuentas = UserController::instance()->cuentasTerceros( $user->idUser);
                if (count($cuentas) > 0) :
                    foreach ($cuentas as $key => $value) : ?>
                        <div class="terceros">
                            <h4><?= $value->alias ?></h4>
                            <h6>Cuenta # <?= $value->idAccount?></h6>
                            <h6>Monto Máximo <?= $value->maxAmount?></h6>
                        </div>
                    <?php       
                    endforeach; 
                endif; ?> 
            </div>

        </div>
    </div>
</body>

</html>