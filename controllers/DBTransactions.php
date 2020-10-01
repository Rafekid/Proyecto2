<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 10/1/2020
 * Time: 12:33 AM
 */

class DBTransactions{

    private static $instance;

    private $conexion = null;

    private $host = "localhost";
    private $usuario = "root";
    private $clave = "";
    private $db = "banca";
    public function __construct()
    {
        $this->conexion=mysqli_connect($this->host,$this->usuario,$this->clave,$this->db);
    }


    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function getRows($query)
    {

        if (!$this->conexion->connect_errno) {


            $data = $this->conexion->query($query);
            if ($data) {
                $rows = [];
                while ($row = $data->fetch_array()) {
                    $rows[] = $row;
                }

                return $rows;
            }else{
                return [];
            }
        }

        return null;
    }

    public function executeQuery($query){
        if (!$this->conexion->connect_errno) {
            $stmt = $this->conexion->prepare($query);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }
        return false;
    }


}