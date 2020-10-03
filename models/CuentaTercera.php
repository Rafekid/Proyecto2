<?php

class CuentaTercera
{
    var $idThirdAccount = 0;
    var $idUser = 0;
    var $idAccount = 0;
    var $maxAmount  = 0;
    var $maxTransactions  = 0;
    var $alias = "";
    var $status = 0;

    public function __construct($idThirdAccount, $idUser, $idAccount, $maxAmount, $maxTransactions, $alias, $status)
    {
        $this->idThirdAccount = $idThirdAccount;
        $this->idUser = $idUser;
        $this->idAccount = $idAccount;
        $this->maxAmount = $maxAmount;
        $this->maxTransactions = $maxTransactions;
        $this->alias = $alias;
        $this->status = $status;
    }
}