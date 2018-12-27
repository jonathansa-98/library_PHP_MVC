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
                $save = $category->save();
                $_SESSION['newcategory'] = $save ? $success_msg:$error_msg;
            }else{
                $_SESSION['newcategory'] = $error_msg;
            }  
        }else{
            $_SESSION['newcategory'] = $error_msg;
        }
        header("Location:".BASE_URL."category/manage");
    }
}


