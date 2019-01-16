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
    
    public function manage(){
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $user = new User();
        $users = $user->getAll();
        require_once 'views/user/manage.php';
    }
    
    public function delete(){
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $success_msg = "Success deleting user.";
        $error_msg = "Delete error, user selected not found.";
        
        if(isset($_GET)){
            $user = new User();
            $user->setLogin($_GET['login']);
            if($user->checkIfUserExistsByLogin()){
                $user->delete();
                $_SESSION['state_user'] = $success_msg;
            }else{
                $_SESSION['state_user'] = $error_msg;
            }
            header('Location:'.BASE_URL.'user/manage');
        }else{
            header('Location:'.BASE_URL);
        }
    }
    
    public function edit(){
        if(isset($_SESSION['userIdentity'])){ // Check if the user has logged
            if(isset($_GET['login']) && $_GET['login'] !== $_SESSION['userIdentity']->getLogin()){ // Not own profile
                Utils::restrictNotLoged();
                Utils::restrictNormalUser();
                $user = new User();
                $user->setLogin($_GET['login']);
                $user = $user->getOne();
            }else{ // Own user profile
                $user = new User();
                $user->setLogin($_SESSION['userIdentity']->getLogin());
                $user = $user->getOne();
            }
            require_once 'views/user/profile.php';
        }else{
            header('Location:'.BASE_URL);
        }
    }
    
    public function saveUpdate(){
        if(isset($_POST)){
            $success_msg = "Success updating user.";
            $error_msg = "Update error, check the fields and try again.";
        
            $user = new User();
            if(isset($_GET['login'])){
                $user->setLogin($_GET['login']);
            }
            $user->setDni($_POST['dni']);
            $user->setEmail($_POST['email']);
            
            $errors = $user->checkData();
            if($errors == 0){
                $save = $user->saveRegister();
                $_SESSION['state_user'] = $save ? $success_msg:$error_msg;
            }else{
                $_SESSION['state_user'] = $error_msg;
            }
            if(isset($_GET['login'])){
                header('Location:'.BASE_URL.'user/edit&login='.$user->getLogin());
            }else{
                header('Location:'.BASE_URL.'user/edit');
            }
        }else{
            header('Location:'.BASE_URL);
        }
    }
}