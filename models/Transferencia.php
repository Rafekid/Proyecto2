<?php

class Transferencia
{
    var $idTransfers = 0;
    var $idOriginAccount = 0;
    var $idDestinationAccount  = 0;
    var $amount = 0;
    var $fecha = 0;

    public function __construct($idTransfers, $idOriginAccount, $idDestinationAccount, $amount, $fecha)
    {
        $this->idTransfers = $idTransfers;
        $this->idOriginAccount = $idOriginAccount;
        $this->idDestinationAccount = $idDestinationAccount;
        $this->amount = $amount;
        $this->fecha = $fecha;
    }
}