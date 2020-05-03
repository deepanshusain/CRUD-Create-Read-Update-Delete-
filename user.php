<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'database.php';

class User{
    private $conn;

    // Constructor
    public function __construct() {
        $database = new Database();
        $db = $database->dbconnection();
        $this->conn = $db;
    }

    // Execute SQL Queries
    public function runQuery($sql){
        
        $stmnt = $this->conn->prepare($sql);
        return $stmnt;
    }

    // Insert
    public function Insert($name ,$email){
        
        try {
            $stmnt = $this->conn->prepare("INSERT INTO crud_users (name , email) VALUES(:name ,:email)");
            $stmnt->bindparam(":name",$name);
            $stmnt->bindparam(":email",$email);
            $stmnt->execute();
            return $stmnt;
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    // Update
    public function Update($name ,$email ,$id){
        
        try {
            $stmnt = $this->conn->prepare("UPDATE crud_users SET name = :name , email = :email WHERE id = :id");
            $stmnt->bindparam(":name",$name);
            $stmnt->bindparam(":email",$email);
            $stmnt->bindparam(":id",$id);
            $stmnt->execute();
            return $stmnt;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    // Delete
    public function Delete($id){
        try {
            $stmnt = $this->conn->prepare("DELETE FROM crud_users WHERE id = :id");
            $stmnt->bindparam(":id",$id);
            $stmnt->execute();
            return $stmnt;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    // Redirect URL method
    public function redirect($url){
        header("Location: $url");
    }
    
}