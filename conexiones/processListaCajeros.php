<?php

    session_start();

    $usuario = $_SESSION['username'];

    /*Aqui restringimos el acceso, si aún no se han logueado y matamos la session*/
    if(!$usuario){
        header("location: loginAdmin.php");
        die();
    } 
    
    $host = "localhost";
    $usuario = "banco";
    $clave = "banco";
    $db = "banco";
    $mysqli = new mysqli($host,$usuario,$clave,$db) or die(mysqli_error($mysqli));
            

    if(isset($_POST['agregar'])){
        $email = $_POST['email'];
        /* $role = $_POST['role']; */
        $role2 = 2;
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $conf_password = $_POST['conf_password'];
        $status1 = 1;
        $name = $_POST['name'];
        if($email=="" OR $phone=="" OR $password=="" OR $conf_password=="" OR $name==""){

            $_SESSION['message'] = "No pueden existir campos vacíos";
            $_SESSION['msg_type'] = "danger";

            header("location: ../agregarCajeros.php");

        }elseif($password!=$conf_password){

            $_SESSION['message'] = "Las contraseñas no coinciden!";
            $_SESSION['msg_type'] = "danger";

            header("location: ../agregarCajeros.php");
        }else{
            
            $_SESSION['message'] = "Se agregó nuevo Cajero al Sistema";
            $_SESSION['msg_type'] = "success";

            header("location: ../agregarCajeros.php");

        $mysqli->query("call create_user('$email','$name','$role2','$phone','$password','$status1')") or die($mysqli->error);
        }

    }

    if(isset($_GET['eliminar'])){
        $id = $_GET['eliminar'];
        $mysqli->query("call delete_user('$id')") or die($mysqli->error());

        $_SESSION['message'] = "Se eliminó registro";
        $_SESSION['msg_type'] = "danger";

        header("location: ../listaCajeros.php");
    }


    if(isset($_POST['editarInactivos'])){
        $id = $_POST['id'];
       /*  $email3 = $_POST['email'];
        $role3 = $_POST['role'];
        $phone3 = $_POST['phone'];
        $password3 = $_POST['password']; */
        $status3 = $_POST['status'];
        /* $name3 = $_POST['name']; */

        $mysqli->query("UPDATE user SET /* email='$email3', role='$role3', phone='$phone3', password='$password3', */status='$status3'/* , name='$name3' */ WHERE id_user = $id") or die($myslqli->error);

        $_SESSION['message'] = "Se realizó el cambio en el estado del cajero!";
        $_SESSION['msg_type'] = "warning";

        header("location: ../bloqueoCajeros.php");
    }
