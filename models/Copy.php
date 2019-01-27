<?php
class Copy{
    private $id;
    private $book_id;
    private $db;
    
    function __construct() {
        $this->db = DB::connect();
    }
    
    function getId() {
        return $this->id;
    }

    function getBookId() {
        return $this->book_id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setBookId($book_id) {
        $this->book_id = $book_id;
    }
    
    function getCopiesByBookId(){
        $sql = "SELECT * FROM book_copy WHERE book_id={$this->book_id};";
        $result = $this->db->query($sql);
        return $result;
    }
    
    function getCopyById(){
        $sql = "SELECT * FROM book_copy WHERE id={$this->id};";
        $result = $this->db->query($sql);
        if(is_object($result) && $result->num_rows == 1) return true;
        else return false;
    }
    
    function delete(){
        $sql = "DELETE FROM book_copy WHERE id={$this->id};";
        return $this->db->query($sql);
    }

    function save(){
        $sql = "INSERT INTO book_copy VALUES(null, {$this->book_id});";
        return $this->db->query($sql);  
    }
    
}