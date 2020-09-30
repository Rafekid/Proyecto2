<?php

class User
{
    var $idUser = 0;
    var $email = "";
    var $name = "";
    var $role = "";
    var $phone = "";
    var $password = 0;
    var $status = 0;

    /**
     * User constructor.
     * @param int $id
     * @param string $nombre
     * @param string $desripcion
     * @param int $precio
     */
    public function __construct($idUser, $email, $name, $role, $phone, $password, $status)
    {
        $this->idUser = $idUser;
        $this->email = $email;
        $this->name = $name;
        $this->role = $role;
        $this->phone = $phone;
        $this->password = $password;
        $this->status = $status;
    }
}