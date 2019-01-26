<?php
require_once 'models/Book.php';
require_once 'models/Copy.php';
class CopyController{
    
    function manage(){
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        if(isset($_GET['book_id'])){
            $book = new Book();
            $book->setId($_GET['book_id']);
            if($book->checkIfBookIdExists()){
                $copy = new Copy();
                $copy->setBookId($book->getId());
                $copies = $copy->getCopiesByBookId();
                require_once 'views/copy/manage.php';
            } else {
                header('Location:'.BASE_URL."book/manage");
            }
        }else{
            header('Location:'.BASE_URL."book/manage");
        }
    }
    
    function delete(){
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $success_msg = "Success deleting copy.";
        $error_msg = "Error, copy doesn't exist.";
        
        if(isset($_GET['id']) && isset($_GET['book_id'])){
            $copy = new Copy();
            $copy->setId($_GET['id']);
            $exist = $copy->getCopyById();
            if($exist){
                $delete = $copy->delete();
                $_SESSION['status_copy'] = $delete ? $success_msg:$error_msg;
            }else{
                $_SESSION['status_copy'] = $error_msg;
            }
            header('Location:'.BASE_URL.'copy/manage&book_id='.$_GET['book_id']);
        }else{
            header('Location:'.BASE_URL.'book/manage');
        }
    }
    
    function create(){
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $success_msg = "Success creating copy.";
        $error_msg = "Error, creating copy.";
        $max_copies_msg = "You have reached maximum number of copies";
        
        if(isset($_GET['book_id'])){
            $copy = new Copy();
            $copy->setBookId($_GET['book_id']);
            // check if the number of copies is greater than the maximum
            if ($copy->getNCopiesByBookId($copy->getBookId())+0 < COPIES){
                $save = $copy->save();
                $_SESSION['status_copy'] = $save ? $success_msg:$error_msg;
                header('Location:'.BASE_URL.'copy/manage&book_id='.$_GET['book_id']);
            } else {
                $_SESSION['status_copy'] = $max_copies_msg;
                header('Location:'.BASE_URL.'copy/manage&book_id='.$_GET['book_id']);
            }
        }else{
            header('Location:'.BASE_URL.'book/manage');
        }
    }
}
