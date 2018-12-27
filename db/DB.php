<?php
require_once 'dbParam.php';
class DB {
    public static function connect(){
        $db = new mysqli(SERVER, USER, PASSWORD, DATABASE);
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}