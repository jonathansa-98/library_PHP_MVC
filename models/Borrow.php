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
    
    // TODO: pass the id of the book and check the next copy that can be borrowed
    function checkNextCopyAvailable() {
        $sql = "select * from borrow where user_login='{$this->user_login}';";
        $result = $this->db->query($sql);
        return $result;
    }
        
    function add(){
        $sql = "insert into borrow values(null, '{$this->user_login}', {$this->book_copy_id}, null, null}');";
        $this->db->query($sql);
    }

}
