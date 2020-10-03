<?php

class Cuenta
{
    var $idAccount = 0;
    var $idUser = 0;
    var $name  = "";
    var $dpi  = "";
    var $amount = 0;
    var $status = 0;

    public function __construct($idAccount, $idUser, $name, $dpi, $amount, $status)
    {
        $this->idUser = $idUser;
        $this->idAccount = $idAccount;
        $this->name = $name;
        $this->dpi = $dpi;
        $this->amount = $amount;
        $this->status = $status;
    }
}