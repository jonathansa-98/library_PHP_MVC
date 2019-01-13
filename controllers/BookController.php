<?php
require_once 'models/Book.php';
class BookController{
    
    public function index() {
       require_once 'views/book/initial.php';
   }

   public function manage() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $book = new Book();
        $books = $book->getAll();
        require_once 'views/book/manage.php';    
    }
    
    public function create() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        require_once 'views/book/create.php';
    }
    
    public function edit() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        // Retrieving the book from the DB
        if(isset($_GET['id'])){
            $edit = true;
            $books = new Book();
            $books->setId($_GET['id']);
            
            $book = $books->getOne();
            require_once 'views/book/create.php';
        } else {
            header('Location:'.BASE_URL.'book/manage');
        }
    }
    
    public function save() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        if(isset($_GET['id'])){
            $success_msg = "Success updating book.";
            $error_msg = "Update error, please check the fields.";
        } else {
            $success_msg = "Success creating book.";
            $error_msg = "Creation error, please check the fields.";
        }
        
        // Save book in db
        if(isset($_POST)){
            $book = new Book();
            if(isset($_GET['id'])){
                $book->setId($_GET['id']);
            }
            $book->setIsbn($_POST['isbn']);
            $book->setName($_POST['name']);
            $book->setDescription($_POST['description']);
            $book->setCategoryId($_POST['category']);
            $book->setAuthorId($_POST['author']);
            
            // Image processing
            $file = $_FILES['image'];
            $filename = $book->getIsbn();
            $mimetype = $file['type'];
            if($mimetype == 'image/png'){
               if(!is_dir('assets/img/book_covers')){
                   mkdir('assets/img/book_covers',0777, true);
               }
            }
            /*
            echo '<pre>';
                print_r($book);
            echo '</pre>';
            */
            // Search for errors
            if($book->checkData()){
                // Saves the author in the DB
                $edit = isset($_GET['id']);
                
                $save = $book->save($edit);
                move_uploaded_file($file['tmp_name'], 'assets/img/book_covers/'.$filename.'.png');
                $_SESSION['state_book'] = $save ? $success_msg:$error_msg;
            }else{
                $_SESSION['state_book'] = $error_msg;
            }  
        }else{
            $_SESSION['state_book'] = $error_msg;
        }
        header("Location:".BASE_URL."book/manage");
    }

    public function delete() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $success_msg = "Success deleting book.";
        $error_msg = "Delete error.";

        if(isset($_GET['id'])){
            $book = new Book();
            $book->setId($_GET['id']);
            $book = $book->getOne();
            unlink("assets/img/book_covers/{$book->getIsbn()}.png");
            // Deletes the book from the DB
            $delete = $book->delete();
            $_SESSION['state_book'] = $delete ? $success_msg:$error_msg;    
        } else {
            $_SESSION['state_book'] = $error_msg;
        }
        header("Location:".BASE_URL."book/manage");
    }
}