<?php
require_once 'models/Reserve.php';
require_once 'models/User.php';
// require_once 'models/Borrow.php';
require_once 'models/Book.php';

class ReserveController{
    
    function create(){
        if (Utils::canUserGoToReserve()){
            if(isset($_GET)){
                $id = $_GET['id'];
                $book = new Book();
                $book->setId($id);
                $book = $book->getOne();
                $user = new User();
                $users = $user->getAll();
                require_once 'views/reserve/new.php';
            }else{
                header('Location:'.BASE_URL);
            }
        } else {
            header('Location:'.BASE_URL.'user/login');
        }
    }
    function checkDates(){
        if(isset($_POST)){
            $id = $_POST['id'];
            $date = $_POST['reservation_date'];
            
            $date1 = new DateTime($date);
            $date2 = new DateTime($date);
            $userDate = $date1->format('Y-m-d');
            
            $date1->sub(new DateInterval('P'.BORROW_DAYS.'D'));
            $dateMinusMaxDays = $date1->format('Y-m-d');
            
            $date2->add(new DateInterval('P'.BORROW_DAYS.'D'));
            $datePlusMaxDays = $date2->format('Y-m-d');

            $reserve = new Reserve();
            $reserve->setBook_id($id);
            if(!isset($_POST['user'])){
                $reserve->setUser_login($_SESSION['userIdentity']->name);
            } else {
                $reserve->setUser_login($_POST['user']);
            }
            $reserve->setReservation_date($userDate);
            $reserve->calcNCopies();
            
            $result = $reserve->checkDates($dateMinusMaxDays, $datePlusMaxDays);
            
            if($result){
                // Creates Reserve
                $reserve->add();
                $_SESSION['state_reserve'] = "Success reserving the book.";
            }else{
                $_SESSION['state_reserve'] = "Error, there are no copies available in $userDate, try another date.";
            }
            header('Location:'.BASE_URL.'reserve/create&id='.$id);
        }
    }
}

