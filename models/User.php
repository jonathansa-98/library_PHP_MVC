<?php

class User {
    
    private $login;
    private $pass;
    private $dni;
    private $email;
    private $role;
    // db conexion to use in db related tasks.
    private $db;
    
    public function __construct() {
        $this->db = DB::connect();
    }
    
    function getLogin() {
        return $this->login;
    }

    function getPass() {
        return $this->pass;
    }

    function getDni() {
        return $this->dni;
    }

    function getEmail() {
        return $this->email;
    }

    function getRole() {
        return $this->role;
    }

    function setLogin($login) {
        $this->login = $this->db->real_escape_string($login);
    }

    function setPass($pass) {
        $this->pass = $this->db->real_escape_string($pass);
    }

    function setDni($dni) {
        $this->dni = $this->db->real_escape_string($dni);
    }

    function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
    }

    function setRole($role) {
        $this->role = $role;
    }
    
    function checkLogin() {
        $sql = "SELECT * FROM user WHERE login = '{$this->login}'";
        $login = $this->db->query($sql);
        
        if(!$this->login || $login->num_rows == 1 ) return false;
        return true;
    }
    
    function checkDni() {
        $sql = "SELECT * FROM user WHERE dni = '{$this->dni}'";
        $login = $this->db->query($sql);
        
        if(!$this->dni || $login->num_rows == 1)return false;
        // Check format
        if(!ctype_alpha(substr($this->dni, -1)) || !is_numeric(substr($this->dni, 0, -1))) return false;
        return true;
    }
    
    function checkEmail() {
        $sql = "SELECT * FROM user WHERE email = '{$this->email}'";
        $login = $this->db->query($sql);
        
        if(!$this->email || $login->num_rows == 1)return false;
        // Check format
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) return false;
        return true;
    }
    
    function checkData(){
        // Number of errors
        $errors = 0;
        if(!$this->checkLogin())$errors++;
        if(!$this->checkDni())$errors++;
        if(!$this->checkEmail())$errors++;
        return $errors;
    }
    
    function saveRegister() {
        $sql = "INSERT INTO user VALUES('{$this->getLogin()}', AES_ENCRYPT('{$this->getPass()}', 'esselte14'), '{$this->getDni()}','{$this->getEmail()}','{$this->getRole()}');";
        $save = $this->db->query($sql);
        
        if($save){
            return true;
        }
        return false;
    }
    
    function login(){
        $result = false;
        $login = $this->login;
        $pass = $this->pass;
        
        // Check if user exists
        $sql = "select login, AES_DECRYPT(pass, 'esselte14') as pass, dni, email, role from user where login = '{$login}' ";
        $loging_in = $this->db->query($sql);
        if($loging_in && $loging_in->num_rows == 1){
            $user = $loging_in->fetch_object("User");
            
            // Check password
            if($pass == $user->pass){
                $result = $user;
            }
        }
        return $result;
    }
    
}
