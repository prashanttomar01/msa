<?php
require_once __DIR__ . '/../config/database.php';

class DbOperations {
    private $conn;
 
    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }
 
    // Generic function to execute SELECT queries (multiple rows)
    public function select($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Select query error: " . $e->getMessage();
        }
    }
 
    // Generic function to execute SELECT query and fetch a single record
    public function fetchOne($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC); // Return a single row
        } catch (PDOException $e) {
            echo "Fetch one query error: " . $e->getMessage();
        }
    }
 
    // Generic function to execute INSERT, UPDATE, DELETE queries
    public function executeQuery($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount(); // Return number of affected rows
        } catch (PDOException $e) {
            echo "Execute query error: " . $e->getMessage();
        }
    }
 
    // Generic function to insert a record and return the last inserted ID
    public function insert($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $this->conn->lastInsertId(); // Return last inserted ID
        } catch (PDOException $e) {
            echo "Insert query error: " . $e->getMessage();
        }
    }
 
    // Generic function to execute an UPDATE query and return the number of affected rows
    public function update($query, $params = []) {
        echo $query;
        echo'<pre>';
        print_r($params);
        return $this->executeQuery($query, $params);
    }
 
    // Generic function to execute a DELETE query and return the number of affected rows
    public function delete($query, $params = []) {
        return $this->executeQuery($query, $params);
    }
 
    // Generic function to count records that match a certain condition
    public function count($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchColumn(); // Return the count (first column)
        } catch (PDOException $e) {
            echo "Count query error: " . $e->getMessage();
        }
    }
 
    // Generic function to check if a record exists based on a condition (returns boolean)
    public function exists($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount() > 0; // Return true if record exists, false otherwise
        } catch (PDOException $e) {
            echo "Exists query error: " . $e->getMessage();
        }
    }
}