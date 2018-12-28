<?php

class Utils{
    
    static function isLibrarian(){
        if(isset($_SESSION['librarian'])){
            return true;
        }else{
            return false;
        }
    }

    static function isNormalUser(){
        if(isset($_SESSION['userIdentity']) && !Utils::isLibrarian()){
            return true;
        }else{
            return false;
        }
    }
    
    static function restrictNotLoged(){
        if(!isset($_SESSION['userIdentity']) && !Utils::isLibrarian()){
            header ('Location:'.BASE_URL);
            exit();
        }
    }
    
    static function restrictNormalUser(){
        if(Utils::isNormalUser()){
            header ('Location:'.BASE_URL);
            exit();
        }
    }

    static function restrictLibrarian(){
        if(Utils::isLibrarian()){
            header ('Location:'.BASE_URL);
            exit();
        }
    }
    
    static function deleteSession($name_session){
        if(isset($_SESSION[$name_session])){
            unset($_SESSION[$name_session]);
        }
    }
    
    static function showCategories() {
        require_once 'models/category.php';
        $category = new Category();
        $categories = $category->getAll();
        return $categories;
    }
}