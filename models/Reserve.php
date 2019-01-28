<?php

class Reserve{
    
    private $id;
    private $user_login;
    private $book_id;
    private $reservation_date;
    private $db;
    private $n_copies;
    
    function __construct() {
       $this->db = DB::connect();
    }
    
    function getId() {
        return $this->id;
    }

    function getUser_login() {
        return $this->user_login;
    }

    function getBook_id() {
        return $this->book_id;
    }

    function getReservation_date() {
        return $this->reservation_date;
    }
    
    function getN_copies() {
        return $this->n_copies;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUser_login($user_login) {
        $this->user_login = $user_login;
    }

    function setBook_id($book_id) {
        $this->book_id = $book_id;
    }

    function setReservation_date($reservation_date) {
        $this->reservation_date = $reservation_date;
    }

    function setN_copies($n_copies) {
        $this->n_copies = $n_copies;
    }

    function calcNCopies(){
        $sql = "select count(*) as total from book_copy where book_id={$this->book_id};";
        $result = $this->db->query($sql);
        $count = $result->fetch_assoc();
        $this->n_copies = $count['total'];
    }
    
    function add(){
        $sql = "insert into reserve values(null, '{$this->user_login}', {$this->book_id}, '{$this->reservation_date}');";
        $this->db->query($sql);
    }
    
    private function checkDateBefore($date){
        $sql = "select count(*) as total from reserve where user_login='{$this->user_login}' and reservation_date between '$date' and '{$this->reservation_date}';";
        $result = $this->db->query($sql);
        $count = $result->fetch_assoc();
        if($count['total'] < $this->n_copies) return true;
        else return false;
    }
    private function checkDateAfter($date){
        $sql = $sql = "select count(*) as total from reserve where user_login='{$this->user_login}' and reservation_date between '{$this->reservation_date}' and '{$date}';";
        $result = $this->db->query($sql);
        $count = $result->fetch_assoc();
        if($count['total'] < $this->n_copies) return true;
        else return false;
    }
    
    function checkDates($date1, $date2){
        if($this->checkDateBefore($date1) && $this->checkDateAfter($date2)) return true;
        return false;
    }
    
    function getAllReservesByUserLogin(){
        $sql = "select * from reserve where user_login='{$this->user_login}';";
        $result = $this->db->query($sql);
        return $result;
    }
    
    function getNCopiesByUserLogin($login) {
        $sql = "select count(*) as total from reserve where user_login='{$login}';";
        $result = $this->db->query($sql);
        $count = $result->fetch_assoc();
        return $count['total'];
    }
}

