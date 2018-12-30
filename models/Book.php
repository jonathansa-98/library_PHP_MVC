<?php

class Book {
    
    private $id;
    private $isbn;
    private $name;
    private $description;
    private $category_id;
    private $author_id;
    private $db;
    
    function __construct() {
        $this->db = DB::connect();
    }
    
    function getId() {
        return $this->id;
    }
    
    function getIsbn() {
        return $this->isbn;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getCategoryId() {
        return $this->category_id;
    }

    function getAuthorId() {
        return $this->author_id;
    }

    function getDb() {
        return $this->db;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIsbn($isbn) {
        $this->isbn = $this->db->real_escape_string($isbn);
    }

    function setName($name) {
        $this->name = $this->db->real_escape_string($name);
    }
    
    function setDescription($description) {
        $this->description = $this->db->real_escape_string($description);
    }

    function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }

    function setAuthorId($author_id) {
        $this->author_id = $author_id;
    }

    function setDb($db) {
        $this->db = $db;
    }

    public function getAll() {
        $books = $this->db->query("SELECT * FROM book ORDER BY id DESC;");
        return $books;
    }
    
    function checkIfBookIdExists(){
        $sql = "SELECT * FROM book WHERE id={$this->id}";
        $result = $this->db->query($sql);
        if (is_object($result)){
            if($result->num_rows == 1 ){
                $book = $result->fetch_object();
                $this->setId($book->id);
                $this->setName($book->name);
                return true;
            }else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function checkIsbn() {
        $sql = "SELECT * FROM book WHERE isbn = '{$this->isbn}'";
        $book = $this->db->query($sql);
        
        if(!$this->isbn || $book->num_rows == 1 ) return false;
        try{
            (int)$this->isbn;
        } catch (Exception $ex) {
            return false;
        }
        return true;
    }
    
    public function checkName() {
        $sql = "SELECT * FROM book WHERE name = '{$this->name}'";
        $book = $this->db->query($sql);
        
        if(!$this->name || $book->num_rows == 1 ) return false;
        return true;
    }
    
    public function checkData() {
        $errors = 0;
        if($this->checkIsbn()) $errors++;
        if($this->checkName()) $errors++;
        return $errors;
    }
    
    public function save($edit) {
        if($edit){
            $sql = "UPDATE book SET isbn={$this->getIsbn()}, name='{$this->getName()}', description='{$this->getDescription()}', category_id={$this->getCategoryId()}, author_id={$this->getAuthorId()} WHERE id={$this->getId()};";
        } else {
            $sql = "INSERT INTO book VALUES(NULL,{$this->getIsbn()},'{$this->getName()}','{$this->getDescription()}',{$this->getCategoryId()},{$this->getAuthorId()});";
        }
        $save = $this->db->query($sql);
        return $save ? true:false;
    }

    public function getOne() {
        $sql = "SELECT * FROM book WHERE id={$this->getId()};";
        $book = $this->db->query($sql);
        return $book->fetch_object("Book");
    }
    
    public function delete() {
        $sql = "DELETE FROM book WHERE id={$this->id}";
        $delete = $this->db->query($sql);
        return $delete ? true:false;
    }

}