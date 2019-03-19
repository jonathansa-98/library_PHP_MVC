<?php

require_once 'models/Borrow.php';
require_once 'models/Reserve.php';

class BorrowController{
    
    public function take() {
        Utils::restrictNotLoged();
        Utils::restrictNormalUser();
        $success_msg = "Success taking copy.";
        $error_msg = "Error, no copy is available.";
        if(isset($_GET['login']) && isset($_GET['id'])){
            $reserve = new Reserve();
            $reserve->setId($_GET['id']);
            $reserve = $reserve->getReserveById();
            $borrow = new Borrow();
            $borrow->setId($reserve->getId());
            $borrow->setUser_login($reserve->getUser_login());
            $copies = $borrow->getCopiesByBookId($reserve->getBook_id());
            // check if copy is available
            $copy = $borrow->getCopyAvailable($copies, $reserve->getReservation_date());
            //echo $copy;
            //die();
            if($copy != -1){
                $borrow->setBook_copy_id($copy);
                $save = $borrow->add(); // Saves the borrow in the DB
                $_SESSION['borrow_state'] = $save ? $success_msg:"Error taking copy";
            }else{
                $_SESSION['borrow_state'] = $error_msg;
            }
            header("Location:".BASE_URL."user/reserves&login={$reserve->getUser_login()}");
        }else{
            $_SESSION['register'] = $error_msg;
            header("Location:".BASE_URL);            
        }
    }    
}