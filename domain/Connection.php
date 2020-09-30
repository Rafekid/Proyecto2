<?php
class Connection 
{
    var $myconn;

    function connect() {
        $con = new mysqli("localhost", "banco", "banco", "banco", "3308");
        if (!$con) {
            die('No se pudo conectar a la base de datos');
        } else {
            $this->myconn = $con;
        }
        return $this->myconn;
    }

    function close() {
        mysqli_close($this->myconn);
    }
}
?>