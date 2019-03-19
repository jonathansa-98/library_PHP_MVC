<?php

class Borrow {
     
    private $id;
    private $user_login;
    private $book_copy_id;
    private $borrowing_date;
    private $return_date;
    private $db;
    
    function __construct() {
        $this->db = DB::connect();
    }
    
    function getId() {
        return $this->id;
    }

    function getUser_login() {
        return $this->user_login;
    }

    function getBook_copy_id() {
        return $this->book_copy_id;
    }

    function getBorrowing_date() {
        return $this->borrowing_date;
    }

    function getReturn_date() {
        return $this->return_date;
    }

    function getDb() {
        return $this->db;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUser_login($user_login) {
        $this->user_login = $user_login;
    }

    function setBook_copy_id($book_copy_id) {
        $this->book_copy_id = $book_copy_id;
    }

    function setBorrowing_date($borrowing_date) {
        $this->borrowing_date = $borrowing_date;
    }

    function setReturn_date($return_date) {
        $this->return_date = $return_date;
    }

    function setDb($db) {
        $this->db = $db;
    }
    
    // Return an array of ints with the ids of the copies from the book_id
    function getCopiesByBookId($bookId) {
        $sql = "SELECT id FROM book_copy WHERE book_id={$bookId};";
        $result = $this->db->query($sql);
        $ids = array();
        if(is_object($result) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ids[] = intval($row['id']);
            }
        } else {
            $ids[] = -1;
        }
        return $ids;
    }

    // TODO: pass the id of the book and check the next copy that can be borrowed
    function getCopyAvailable($copies, $reserve_date) {
        foreach ($copies as $copy) {
            $sql = "select * from borrow where book_copy_id={$copy};";
            $result = $this->db->query($sql);
            if($result->num_rows == 0){
                return $copy;
            } else {
                $sql = "select * from borrow where book_copy_id={$copy} and "
                . "return_date IS NOT NULL;";
                $result = $this->db->query($sql);
                if($result->num_rows == 0) return $copy;
            }
        }
        return -1;
    }
        
    function add(){
        $sql = "insert into borrow values({$this->id}, '{$this->user_login}', "
             . "{$this->book_copy_id}, NOW(), null);";
        return $this->db->query($sql);
    }

}
