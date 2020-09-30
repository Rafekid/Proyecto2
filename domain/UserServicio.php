<?php 
include("Connection.php");
include("./models/User.php");
class UserServicio
{
    function SetUser(User $user) {
        $connection = new Connection();
        $connection->connect();
        $stmt = $connection->myconn->prepare("call create_user( ". $user->email.", ". $user->name.", ". $user->role.", ". $user->phone.", ". $user->password.", ". $user->status.");");
        $stmt->execute();
        $stmt->close();
        $connection->close();
    }

    public function GetUsers () {
        $connection = new Connection();
        $connection->connect();

        $query = 'SELECT * FROM  `user`';
        $result = mysqli_query($connection->myconn, $query);
        $users = [];
      
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $idUser = $row['id_user'];
                $nombre = $row['nombre'];
                $email = $row['email'];
                $role = $row['role'];
                $phone = $row['phone'];
                $password = $row['password'];
                $status = $row['status'];
                $user = new User($idUser, $email, $nombre, $role, $phone, $password, $status);
                $users [] = $user;
            }
        }
        $connection->close();
        return $users;
    }

    function UpdateUser(User $user) {
        $connection = new Connection();
        $connection->connect();
        $stmt = $connection->myconn->prepare("call update_account( ". $user->idUser.", ". $user->email.", ". $user->name.", ". $user->role.", ". $user->phone.", ". $user->password.", ". $user->status.");");
        $stmt->execute();
        $stmt->close();
        $connection->close();
    }

    function DeleteUser(int $idUser) {
        $connection = new Connection();
        $connection->connect();
        $stmt = $connection->myconn->prepare("call delete_account( ". $idUser .");");
        $stmt->execute();
        $stmt->close();
        $connection->close();
    }

    public function GetUserById ($userId) {
        $connection = new Connection();
        $connection->connect();
        $stmt = $connection->myconn->prepare("SELECT * FROM `user` WHERE id_user = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $userResult = $result->fetch_assoc();
        $user = new User($userResult['id_user'], $userResult['email'], $userResult['name'], $userResult['role'], $userResult['phone'], 
                    $userResult['password'], $userResult['status']);
        $connection->close();
        return $user;
    }

    public function Login ($email, $password) {
        $connection = new Connection();
        $connection->connect();
        $stmt = $connection->myconn->prepare("SELECT * FROM `user` WHERE `email` = ? and `password` = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $userResult = $result->fetch_assoc();
        $user = new User($userResult['id_user'], $userResult['email'], $userResult['name'], $userResult['role'], $userResult['phone'], 
                    $userResult['password'], $userResult['status']);
        $connection->close();
        return $user;
    }
}
?>