<?php
class Database {
    protected $conn;

    public function __construct() {
        $this->conn = mysqli_connect("localhost", "root", "", "student_management_system_db");

        if (!$this->conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
