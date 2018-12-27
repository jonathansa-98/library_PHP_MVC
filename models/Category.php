<?php

class Category {
    
    public $id;
    public $name;
    public $db;
    
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
        $this->id = $id;
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
        $sql = "SELECT * FROM category WHERE category_name = '{$this->name}'";
        $category = $this->db->query($sql);
        
        if(!$this->name || $category->num_rows == 1 ) return false;
        if(!preg_match('/^[a-zA-Z -]+$/D', $this->name)) return false;
        return true;
    }
    
    public function save() {
        $sql = "INSERT INTO category VALUES(NULL,'{$this->getName()}');";
        $save = $this->db->query($sql);
        
        if($save){
            return true;
        }
        return false;
    }

}