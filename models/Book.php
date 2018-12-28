<?php

class Book {
    
    private $isbn;
    private $name;
    private $description;
    private $category_id;
    private $author_id;
    private $db;
    
    function __construct() {
        $this->db = DB::connect();
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

    function getCategory_id() {
        return $this->category_id;
    }

    function getAuthor_id() {
        return $this->author_id;
    }

    function getDb() {
        return $this->db;
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

    function setCategory_id($category_id) {
        $this->category_id = $category_id;
    }

    function setAuthor_id($author_id) {
        $this->author_id = $author_id;
    }

    function setDb($db) {
        $this->db = $db;
    }

    public function getAll() {
        $books = $this->db->query("SELECT * FROM book ORDER BY name;");
        return $books;
    }
    /*
    public function checkName() {
        $sql = "SELECT * FROM author WHERE name = '{$this->name}'";
        $author = $this->db->query($sql);
        
        if(!$this->name || $author->num_rows == 1 ) return false;
        return true;
    }
    
    public function save($edit) {
        if($edit){
            $sql = "UPDATE author SET name='{$this->getName()}' WHERE id={$this->getId()};";
        } else {
            $sql = "INSERT INTO author VALUES(NULL,'{$this->getName()}');";
        }
        $save = $this->db->query($sql);
        return $save ? true:false;
    }
    
    public function getOne() {
        $sql = "SELECT * FROM author WHERE id={$this->getId()};";
        $author = $this->db->query($sql);
        return $author->fetch_object("Author");
    }
    
    public function delete() {
        $sql = "DELETE FROM author WHERE id={$this->id}";
        $delete = $this->db->query($sql);
        return $delete ? true:false;
    }*/

}