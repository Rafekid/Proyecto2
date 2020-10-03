<?php

class Transaccion
{
    var $idTransaction = 0;
    var $idUser = 0;
    var $idAccount = 0;
    var $type = "";
    var $monto = 0;
    var $fecha = 0;

    public function __construct($idTransaction, $idUser, $idAccount, $type, $monto, $fecha)
    {
        $this->idTransaction = $idTransaction;
        $this->idUser = $idUser;
        $this->idAccount = $idAccount;
        $this->type = $type;
        $this->monto = $monto;
        $this->fecha = $fecha;
    }
}