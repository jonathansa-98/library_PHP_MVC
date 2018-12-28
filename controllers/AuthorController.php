<?php
require_once 'models/Author.php';
class AuthorController{
    
    public function manage() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $author = new Author();
        $authors = $author->getAll();
        require_once 'views/author/manage.php';    
    }
    
    public function create() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        require_once 'views/author/create.php';
    }
    
    public function edit() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        // Retrieving the author from the DB
        if(isset($_GET['id'])){
            $edit = true;
            $author = new Author();
            $author->setId($_GET['id']);
            
            $aut = $author->getOne();
            require_once 'views/author/create.php';
        } else {
            header('Location:'.BASE_URL.'author/manage');
        }
    }
    
    public function saveEdit() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $success_msg = "Success updating author.";
        $error_msg = "Update error, please write a valid name.";
        
        // Save author in db
        if(isset($_POST['name'])){
            $aut = new Author();
            $aut->setId($_GET['id']);
            $aut->setName($_POST['name']);
            
            // Search for errors
            if($aut->checkName()){
                // Saves the author in the DB
                $edit = true;
                $save = $aut->save($edit);
                $_SESSION['state_aut'] = $save ? $success_msg:$error_msg;
            }else{
                $_SESSION['state_aut'] = $error_msg;
            }  
        }else{
            $_SESSION['state_aut'] = $error_msg;
        }
        header("Location:".BASE_URL."author/manage");
    }
    
    public function save() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $success_msg = "Success creating author.";
        $error_msg = "Creation error, please write a valid name.";
        
        // Save author in db
        if(isset($_POST['name'])){
            $author = new Author();
            $author->setName($_POST['name']);
            
            // Search for errors
            if($author->checkName()){
                // Saves the author in the DB
                $save = $author->save(false);
                $_SESSION['state_aut'] = $save ? $success_msg:$error_msg;
            }else{
                $_SESSION['state_aut'] = $error_msg;
            }  
        }else{
            $_SESSION['state_aut'] = $error_msg;
        }
        header("Location:".BASE_URL."author/manage");
    }
    
    public function delete() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $success_msg = "Success deleting author.";
        $error_msg = "Delete error.";

        if(isset($_GET['id'])){
            $author = new Author();
            $author->setId($_GET['id']);
             
            // Deletes the author from the DB
            $delete = $author->delete();
            $_SESSION['state_aut'] = $delete ? $success_msg:$error_msg;    
        } else {
            $_SESSION['state_aut'] = $error_msg;
        }
        header("Location:".BASE_URL."author/manage");
    }
}