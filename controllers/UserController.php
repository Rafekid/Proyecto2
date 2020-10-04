<?php
class UserController
{
    public static $instance;
    private $session_name = 'cjr_sss_1';

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

    public function GetUser($id){
        $userServicio = new UserServicio();
        return $userServicio->GetUserById($id);
    }

    public function GetUsers() {
        $userServicio = new UserServicio();
        return $userServicio->GetUsers();
    }

    public function Login($email, $password) {
        $connection = DBTransactions::getInstance();
        $stmt = $connection->conexion->prepare("SELECT * FROM `user` WHERE `email` = ? AND `password` = ? AND role = 3");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $userResult = $result->fetch_assoc();

        if ($result->num_rows == 0) {
            return false;
        }

        $user = new User($userResult['id_user'], $userResult['email'], $userResult['name'], $userResult['role'], $userResult['phone'], 
                        '', $userResult['status']);
        $connection->conexion->close();
        $_SESSION[$this->session_name] = $user;
        return true;
    }

    public function check(){
        if (isset($_SESSION[$this->session_name]) == "") {
            return false;
        } 
        else {
            return true;
        }
    }  

    public function transacciones($idUser){
        $connection = DBTransactions::getInstance();
        $stmt = $connection->conexion->prepare("SELECT * FROM `transaction` WHERE id_user = ?");
        $stmt->bind_param("i", $idUser);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $transaciones = [];
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $transaction = new Transaccion($row["id_transaction"], $row["id_user"], $row["id_account"], $row["type"], $row["monto"], $row["fecha"] );
                $transaciones [] = $transaction;
            }
        }
  
        return $transaciones;
    }

    public function cuentas($idUser){
        $connection = DBTransactions::getInstance();
        $stmt = $connection->conexion->prepare("SELECT * FROM `account` WHERE id_user = ?");
        $stmt->bind_param("i", $idUser);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $cuentas = [];
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $cuenta = new Cuenta($row["id_account"], $row["id_user"], $row["name"], $row["dpi"], $row["amount"], $row["status"] );
                $cuentas [] = $cuenta;
            }
        }
  
        return $cuentas;
    }

    public function cuentasTerceros($idUser){
        $connection = DBTransactions::getInstance();
        $stmt = $connection->conexion->prepare("SELECT * FROM `third_party_account` WHERE id_user = ?");
        $stmt->bind_param("i", $idUser);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $cuentas = [];
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $cuenta = new CuentaTercera($row["id_third_account"], $row["id_user"], $row["id_account"], $row["max_amount"], $row["max_transactions"], $row["alias"], $row["status"]);
                $cuentas [] = $cuenta;
            }
        }
        return $cuentas;
    }

    
    public function crearcuentaTerceros(CuentaTercera $cuenta){
        $connection = DBTransactions::getInstance();


        $cuentas = $this->cuentas($cuenta->idUser);

        if (count($cuentas) > 0) {
            foreach ($cuentas as $key => $value) {
                if ($value->idAccount == $cuenta->idAccount) {
                    return 2;
                }
            }
        }

        $cuentasTerceras = $this->cuentasTerceros($cuenta->idUser);

        if (count($cuentasTerceras) > 0) {
            foreach ($cuentasTerceras as $key => $value) {
                if ($value->idAccount == $cuenta->idAccount) {
                    return 3;
                }
            }
        }

        $stmt = $connection->conexion->prepare("SELECT * FROM `account` WHERE `id_account` = ? AND `status` = 1 AND `id_user` != ? ");
        $stmt->bind_param("ii", $cuenta->idAccount, $cuenta->idUser);
        $stmt->execute();
        $result = $stmt->get_result(); 
        
        if ($result->num_rows == 0) {
            return 4;
        }
       
        $stmt2 = $connection->conexion->prepare("CALL create_third_account(?, ?, ?, ?, ?, ?);");
        $stmt2->bind_param("iidisi", $cuenta->idUser, $cuenta->idAccount, $cuenta->maxAmount, $cuenta->maxTransactions, $cuenta->alias, $cuenta->status);
        $stmt2->execute();
        return 1;
    }

    public function crearCuentayUsuario($account, $email, $name, $rol, $phone, $pass, $estado){
        $connection = DBTransactions::getInstance();
        $stmt = $connection->conexion->prepare("CALL create_user_account(?,?, ?, ?, ?, ?, ?); ");
        $stmt->bind_param("ississb", $account, $email, $name, $rol,$phone, $pass, $estado );
        $stmt->execute();
        $error = $connection->conexion->error;
        $stmt->close();
        return $error;
    }
}