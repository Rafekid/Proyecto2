<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/usuario.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <script src="https://kit.fontawesome.com/3152c32f70.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Usuario</title>
</head>
<?php
include "../models/User.php";
include "../models/Transaccion.php";
include "../models/CuentaTercera.php";
include "../models/Cuenta.php";
include "../models/Transferencia.php";
include "../controllers/UserController.php";
include "../controllers/DBTransactions.php";
include "../helpers/AuthRedirectIfLoguedUser.php";
$session_name = 'cjr_sss_1';
?>