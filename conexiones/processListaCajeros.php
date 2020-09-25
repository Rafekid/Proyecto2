<?php

    session_start();

    $usuario = $_SESSION['username'];

    /*Aqui restringimos el acceso, si aún no se han logueado y matamos la session*/
    if(!$usuario){
        header("location: loginAdmin.php");
        die();
    } 

    $host = "localhost";
    $usuario = "admin1";
    $clave = "1234";
    $db = "banco";
    $mysqli = new mysqli($host,$usuario,$clave,$db) or die(mysqli_error($mysqli));

    if(isset($_POST['confirmar'])){
        $email = $_POST['email'];
        $role = $_POST['role'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $status = $_POST['status'];
        $name = $_POST['name'];

        $mysqli->query("call create_user('$email','$name','$role','$phone','$password','$status')") or die($mysqli->error);
    }