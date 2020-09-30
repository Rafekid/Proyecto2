<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 8/23/2020
 * Time: 7:46 PM
 */
include("./domain/UserServicio.php");

class UserController
{
    private static $instance;

    public static function instance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function GetUser($id){
        $userServicio = new UserServicio();
        return $userServicio->GetUserById($id);
    }

    public function GetUsers() {
        $userServicio = new UserServicio();
        return $userServicio->GetUsers();
    }

    public function Login($email, $password) {
        $userServicio = new UserServicio();
        return $userServicio->Login($email, $password);
    }
}