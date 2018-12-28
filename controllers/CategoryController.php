<?php
require_once 'models/Category.php';
class CategoryController{
    
    public function manage() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $category = new Category();
        $categories = $category->getAll();
        require_once 'views/category/manage.php';    
    }
    
    public function create() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        require_once 'views/category/create.php';
    }
    
    public function edit() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        // Retrieving the category from the DB
        if(isset($_GET['id'])){
            $edit = true;
            $category = new Category();
            $category->setId($_GET['id']);
            
            $cat = $category->getOne();
            require_once 'views/category/create.php';
        } else {
            header('Location:'.BASE_URL.'category/manage');
        }
    }
    
    public function saveEdit() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $success_msg = "Success updating category.";
        $error_msg = "Update error, please write a valid name.";
        
        // Save category in db
        if(isset($_POST['name'])){
            $cat = new Category();
            $cat->setId($_GET['id']);
            $cat->setName($_POST['name']);
            
            // Search for errors
            if($cat->checkName()){
                // Saves the category in the DB
                $edit = true;
                $save = $cat->save($edit);
                $_SESSION['state_cat'] = $save ? $success_msg:$error_msg;
            }else{
                $_SESSION['state_cat'] = $error_msg;
            }  
        }else{
            $_SESSION['state_cat'] = $error_msg;
        }
        header("Location:".BASE_URL."category/manage");
    }
    
    public function save() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $success_msg = "Success creating category.";
        $error_msg = "Creation error, please write a valid name.";
        
        // Save category in db
        if(isset($_POST['name'])){
            $category = new Category();
            $category->setName($_POST['name']);
            
            // Search for errors
            if($category->checkName()){
                // Saves the user in the DB
                $save = $category->save(false);
                $_SESSION['state_cat'] = $save ? $success_msg:$error_msg;
            }else{
                $_SESSION['state_cat'] = $error_msg;
            }  
        }else{
            $_SESSION['state_cat'] = $error_msg;
        }
        header("Location:".BASE_URL."category/manage");
    }
    
    public function delete() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $success_msg = "Success deleting category.";
        $error_msg = "Delete error.";

        if(isset($_GET['id'])){
            $category = new Category();
            $category->setId($_GET['id']);
             
            // Deletes the category from the DB
            $delete = $category->delete();
            $_SESSION['state_cat'] = $delete ? $success_msg:$error_msg;    
        } else {
            $_SESSION['state_cat'] = $error_msg;
        }
        header("Location:".BASE_URL."category/manage");
    }
}