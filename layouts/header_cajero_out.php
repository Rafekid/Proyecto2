<?php
include "../models/User.php";
include "../controllers/CajeroController.php";
include "../controllers/DBTransactions.php";
include "../helpers/AuthRedirectIfLogued.php";

$message =  isset($_SESSION["error"]) ?$_SESSION["error"] :"";
unset($_SESSION["error"]);

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if($_POST["usuario"] && $_POST["contrasena"]){
        $logued = CajeroController::instance()->login($_POST["usuario"], $_POST["contrasena"]);
        if($logued){
            header("location: ./index.php");
        }else{
            $_SESSION["error"] = "Lo sentimos los datos que ingreso no se encuentran en nuestros registros.";
            header("location: ./login.php");
        }
    }
}
?>
