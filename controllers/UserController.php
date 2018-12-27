<?php

require_once 'models/User.php';

class UserController{
    
    public function register() {
        Utils::restrictNormalUser();
        require_once 'views/user/register.php';
    }
    
    public function saveRegister() {
        Utils::restrictNormalUser();
        $success_msg = "Success registering user.";
        $error_msg = "Register error, please check all the fields.";
        if(isset($_POST)){
            $user = new User();
            $user->setLogin($_POST['login']);
            $user->setPass($_POST['pass']);
            $user->setDni($_POST['dni']);
            $user->setEmail($_POST['email']);
            $user->setRole('user');
            
            // Search for errors
            $errors = $user->checkData();
            if($errors == 0){
                // Saves the user in the DB
                $save = $user->saveRegister();
                $_SESSION['register'] = $save ? $success_msg:$error_msg;
            }else{
                $_SESSION['register'] = $error_msg;
            }  
        }else{
            $_SESSION['register'] = $error_msg;
        }
        header("Location:".BASE_URL."user/register");
    }
    
    function login(){
        Utils::restrictNormalUser();
        Utils::restrictLibrarian();
        require_once 'views/user/login.php';
    }
    
    function saveLogin(){
        Utils::restrictNormalUser();
        Utils::restrictLibrarian();
        $success_msg = "Success login user.";
        $error_msg = "Error login, please check all the data.";
        
        if(isset($_POST)){
            // Query to DB
            $user = new User();
            $user->setLogin($_POST['login']);
            $user->setPass($_POST['pass']);
            $userIdentified = $user->login();
            
            // Create session
            if($userIdentified && is_a($userIdentified, "User")){
                $_SESSION['userIdentity'] = $userIdentified;
                $_SESSION['login'] = $success_msg;
                if($userIdentified->getRole() == "librarian"){
                    $_SESSION['librarian'] = true;
                } 
            }else{
                $_SESSION['login'] = $error_msg;
            }
        }else{
            $_SESSION['login'] = $error_msg;
        }
        if(isset($_SESSION['userIdentity'])) header ('Location:'.BASE_URL);
        else header("Location:".BASE_URL."user/login");
    }
    
    public function logout(){
        if(isset($_SESSION['userIdentity'])){
            unset($_SESSION['userIdentity']);
        }
        if(isset($_SESSION['librarian'])){
            unset($_SESSION['librarian']);
        }
        
        header("Location:".BASE_URL);
    }
}