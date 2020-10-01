<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 10/1/2020
 * Time: 12:52 AM
 */
class CajeroController{
    public static $instance;

    private $session_name = 'cjr_sss';


    public function __construct()
    {
        if(session_id() == '')
        {
            session_start();
        }
    }

    public static function instance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function login($email, $password){

        $query = "SELECT id_user, email, role, phone, name FROM user WHERE password = '$password' AND email = '$email' AND role = 2";

        $rows = DBTransactions::getInstance()->getRows($query);

        if(!$rows){
           return false;
        }

        $row = reset($rows);
        $usuario = new User( $row['id_user'], $row['email'], $row['name'],$row['role'],$row['phone'],'',1 );
        $_SESSION[$this->session_name] = serialize($usuario);

        return true;
    }

    public function check(){

        return isset($_SESSION[$this->session_name]);
    }
}