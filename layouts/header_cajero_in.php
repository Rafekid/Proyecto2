<?php
include "../models/User.php";
include "../controllers/CajeroController.php";
include "../controllers/DBTransactions.php";
include "../helpers/AuthRedirect.php";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/cajero.css">
    <script src="https://kit.fontawesome.com/3152c32f70.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <title>Cajero</title>
</head>

<header>
    <section class="wrapper">
        <nav>
            <ul>
                <li class="<?php if($section == "home") echo "active"; ?>"><a href="./index.php"><i class="fas fa-user-shield" aria-hidden="true"></i></a></li>
                <li class="<?php if($section == "create") echo "active"; ?>"><a href="./create_account.php">Creación Cuenta</a></li>
                <li class="<?php if($section == "deposit") echo "active"; ?>"><a href="./deposit.php">Depósito</a></li>
                <li class="<?php if($section == "retirement") echo "active"; ?>"><a href="./retirement.php">Retiro</a></li>
                <li class="right"><a href="./logout.php"><i class="fas fa-power-off" aria-hidden="true"></i></a></a></li>
            </ul>
        </nav>
    </section>
</header>