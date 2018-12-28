<?php

class Author {
    
    private $id;
    private $name;
    private $db;
    
    function __construct() {
        $this->db = DB::connect();
    }
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDb() {
        return $this->db;
    }

    function setId($id) {
        $this->id = $this->db->real_escape_string($id);
    }

    function setName($name) {
        $this->name = $this->db->real_escape_string($name);
    }

    function setDb($db) {
        $this->db = $db;
    }
    
    public function getAll() {
        $authors = $this->db->query("SELECT * FROM author ORDER BY id DESC;");
        return $authors;
    }
    
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
    }

}