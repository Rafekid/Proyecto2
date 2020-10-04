<!DOCTYPE html>
<html lang="en">
<?php 
include "../layouts/headUsuario.php";
include "navbar.php";
$user = $_SESSION[$session_name];
$cuenta = UserController::instance()->cuentaById($user->idUser); 
$cuentaTerceros = UserController::instance()->cuentasTerceros($user->idUser);?>

<body>
    <div class="contenido wrapper">
        <h1>Bienvenido <?= $user->name ?></h1>
        <div id="contenedor" class="clearfix">
        
            <div id="principal">
                <h1>Transacciones de transferencia</h1>
                <?php 
                $historial = UserController::instance()->History( $cuenta->idAccount);
                if (count($historial) > 0) :
                    foreach ($historial as $key => $value) : ?>
                        <div class="transactions">
                            <?php 
                            foreach ($cuentaTerceros as $key2 => $value2) : 
                                if ($value2->idAccount == $value->idDestinationAccount) : ?>
                                <h5><?= $value2->alias ?></h5>
                                <?php
                                endif;
                            endforeach; 
                            ?>
                            <h6><?= $value->amount ?></h6>
                            <h6><?= $value->fecha ?></h6>
                        </div>
                    <?php       
                    endforeach; 
                endif; ?> 
                 
            </div>

        </div>
    </div>
</body>

</html>