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
        require_once 'models/Category.php';
        $category = new Category();
        $categories = $category->getAll();
        return $categories;
    }
    
    static function showAuthors() {
        require_once 'models/Author.php';
        $author = new Author();
        $authors= $author->getAll();
        return $authors;
    }
    
    static function getCategoryById($id) {
        require_once 'models/Category.php';
        $category = new Category();
        $category->setId($id);
        return $category->getOne();
    }
    
    static function getAuthorById($id) {
        require_once 'models/Author.php';
        $author = new Author();
        $author->setId($id);
        return $author->getOne();
    }
}