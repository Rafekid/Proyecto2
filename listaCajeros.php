<?php

    session_start();

    $usuario = $_SESSION['username'];

    /*Aqui restringimos el acceso, si aún no se han logueado y matamos la session*/
    if(!$usuario){
        header("location: loginAdmin.php");
        die();
    } 

?>

<!DOCTYPE html>
<html lang="en">
<?php include "layouts/headAdmin.php";?>
<body>

</body>
</html>