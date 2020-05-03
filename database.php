<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Database{
    
    private $host     = "localhost";
    private $dbname   = "crud";
    private $username = "root";
    private $password = "";
    
    public $conn;
    
    //Method return Database Connection
    public function dbconnection(){
        
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->username, $this->password, array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"    
            ));
            
        } catch (PDOException $ex) {
            echo 'Connection error: '.$ex->getMessage();
        }
        return $this->conn;
    }
}
