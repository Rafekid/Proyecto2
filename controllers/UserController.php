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
        $connection = new DBTransactions();
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
        $connection = new DBTransactions();
        $stmt = $connection->conexion->prepare("SELECT * FROM `account` WHERE id_user = ? AND `status` = 1");
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

    public function cuenta($idAccount) {
        $connection = new DBTransactions();
        $stmt = $connection->conexion->prepare("SELECT * FROM `account` WHERE `id_account` = ?");
        $stmt->bind_param("i", $idAccount);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $userResult = $result->fetch_assoc();
        $cuenta = new Cuenta($userResult["id_account"], $userResult["id_user"], $userResult["name"], $userResult["dpi"], $userResult["amount"], $userResult["status"] );
        $connection->conexion->close();
        return $cuenta;
    }

    public function cuentaById($idUser) {
        $connection = new DBTransactions();
        $stmt = $connection->conexion->prepare("SELECT * FROM `account` where `id_user` = ? LIMIT 1");
        $stmt->bind_param("i", $idUser);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $userResult = $result->fetch_assoc();
        $cuenta = new Cuenta($userResult["id_account"], $userResult["id_user"], $userResult["name"], $userResult["dpi"], $userResult["amount"], $userResult["status"] );
        $connection->conexion->close();
        return $cuenta;
    }

    public function transeferencias($cuentaOrigen, $cuentaDestino){
        $connection = new DBTransactions();
        $stmt = $connection->conexion->prepare("SELECT * FROM `transfers` WHERE id_origin_account = ? AND `id_destination_account` = ?");
        $stmt->bind_param("ii", $cuentaOrigen, $cuentaDestino);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $transferencias = [];
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $transferencia = new Transferencia($row["id_transfers"], $row["id_origin_account"], $row["id_destination_account"], $row["amount"], $row["fecha"] );
                $transferencias [] = $transferencia;
            }
        }
  
        return $transferencias;
    }

    public function cuentasTerceros($idUser){
        $connection = new DBTransactions();
        $stmt = $connection->conexion->prepare("SELECT * FROM `third_party_account` WHERE id_user = ? AND `status` = 1");
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

    public function cuentaTercero($idAccount, $idUser) {
        $connection = new DBTransactions();
        $stmt = $connection->conexion->prepare("SELECT * FROM `third_party_account` WHERE `id_account` = ? AND `id_user` = ?");
        $stmt->bind_param("ii", $idAccount, $idUser);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $userResult = $result->fetch_assoc();
        $cuenta = new CuentaTercera($userResult["id_third_account"], $userResult["id_user"], $userResult["id_account"], $userResult["max_amount"], $userResult["max_transactions"], $userResult["alias"], $userResult["status"]);
        $connection->conexion->close();
        return $cuenta;
    }

    public function crearcuentaTerceros(CuentaTercera $cuenta){
        $connection = new DBTransactions();
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

    public function transferir($idUser, $cuentaOrigen, $cuentaDestino, $amount) {
        $connection = new DBTransactions();
        $transferencias = $this->transeferencias($cuentaOrigen, $cuentaDestino);
        $cuentaTercero = $this->cuentaTercero($cuentaDestino, $idUser);
        $cuenta = $this->cuenta($cuentaOrigen);
        $cuentaThird = $this->cuenta($cuentaDestino);
        
        if (count($transferencias) >= $cuentaTercero->maxTransactions) {
           return 2;
        }

        if ($amount > $cuentaTercero->maxAmount) {
            return 3;
        }

        if ($amount > $cuenta->amount) {
            return 4;
        }
        
        $stmt = $connection->conexion->prepare("CALL transeferencia(?, ?, ?, ?, ?);");
        $stmt->bind_param("iiiid", $idUser, $cuentaThird->idUser, $cuentaOrigen, $cuentaDestino, $amount);
        $stmt->execute();

        $this->sumOrRestAmount($amount, $cuentaOrigen, "rest");
        $this->sumOrRestAmount($amount, $cuentaDestino, "sum");
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

    public function activateAcount($email){
        $connection = DBTransactions::getInstance();
        $stmt = $connection->conexion->prepare("UPDATE USER SET status = 1 WHERE email=?");
        $stmt->bind_param("S", $email);
        $stmt->execute();
        $error = $connection->conexion->error;
        $stmt->close();
        return $error;
    }


    public function sumOrRestAmount($amount, $idAccount, $action) {
        $connection = new DBTransactions();
        $cuenta = $this->cuenta($idAccount);
        $newAmoun = 0;
        if ($action == "rest") {
            $newAmoun = $cuenta->amount - $amount;
        } else {
            $newAmoun = $cuenta->amount + $amount;
        }

        $stmt = $connection->conexion->prepare("UPDATE account SET `amount` = ? WHERE id_account = ?");
        $stmt->bind_param("di", $newAmoun, $idAccount);
        $stmt->execute();
        $error = $connection->conexion->error;
        $stmt->close();
        return $error;
    }

    public function History($idAccount){
        $connection = new DBTransactions();
        $stmt = $connection->conexion->prepare("SELECT * FROM `transfers` WHERE `id_origin_account` = ? ");
        $stmt->bind_param("i", $idAccount);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $history = [];
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $cuenta = new Transferencia($row["id_transfers"], $row["id_origin_account"], $row["id_destination_account"], $row["amount"], $row["fecha"]);
                $history [] = $cuenta;
            }
        }
  
        return $history;
    }
}