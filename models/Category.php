<?php

class Category {
    
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
        $categories = $this->db->query("SELECT * FROM category ORDER BY id DESC;");
        return $categories;
    }
    
    public function checkName() {
        $sql = "SELECT * FROM category WHERE name = '{$this->name}'";
        $category = $this->db->query($sql);
        
        if(!$this->name || $category->num_rows == 1 ) return false;
        return true;
    }
    
    public function save($edit) {
        if($edit){
            $sql = "UPDATE category SET name='{$this->getName()}' WHERE id={$this->getId()};";
        } else {
            $sql = "INSERT INTO category VALUES(NULL,'{$this->getName()}');";
        }
        $save = $this->db->query($sql);
        
        if($save){
            return true;
        }
        return false;
    }
    
    public function getOne() {
        $sql = "SELECT * FROM category WHERE id={$this->getId()};";
        $category = $this->db->query($sql);
        return $category->fetch_object("Category");
    }
    
    public function delete() {
        $sql = "DELETE FROM category WHERE id={$this->id}";
        $delete = $this->db->query($sql);
        return $delete ? true:false;
    }

}