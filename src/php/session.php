<?php

class Session{

    public function __construct($username,$role){
        global $conn;
        $result = mysqli_query($conn,"SELECT * FROM account WHERE username='$username' AND role='$role'");
        if($d=mysqli_fetch_array($result)){
            $this->id = $d['id_acc'];
            $this->first_name = $d['first_name'];
            $this->last_name = $d['last_name'];
            $this->age = $d['age'];
            $this->email = $d['email'];
            $this->username = $d['username'];
            $this->role = $d['role'];
        }
    }
}

class SessionManager{

    public static string $SECRET_KEY = "fkajw'afq1.r,fmlw;a'fwa";

    public static function login($username,$password): bool{
        global $conn;
        $result = mysqli_query($conn,"SELECT * FROM account WHERE username='$username' AND password=MD5('$password')");
        if($d = mysqli_fetch_array($result)){
            $payload = [
                "username" => $d['username'],
                "role"  =>   $d['role']
            ];
            $jwt = \Firebase\JWT\JWT::encode($payload,SessionManager::$SECRET_KEY,'HS256');
            setcookie("SESSION_HIS",$jwt);
            return true;
        }else{
            return false;
        }
    }

    public static function getCurrentSession(): Session{
        if($_COOKIE['SESSION_HIS']){
            $jwt = $_COOKIE['SESSION_HIS'];
            try {
                $payload = \Firebase\JWT\JWT::decode($jwt,SessionManager::$SECRET_KEY,['HS256']);
                return new Session($payload->username,$payload->role);
            } catch (Exception $ex) {
                throw new Exception('User is not loged in');
            }
        }else{
            throw new Exception('User is not loged in');
        }
    }
}