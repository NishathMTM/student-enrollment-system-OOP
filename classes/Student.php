<?php
require_once 'Database.php';

class Student extends Database {

    public function add($full_name, $email, $phone) {
        $sql = "INSERT INTO students (full_name, email, phone)
                VALUES ('$full_name', '$email', '$phone')";
        return mysqli_query($this->conn, $sql);
    }

    public function getAll() {
        return mysqli_query($this->conn, "SELECT * FROM students");
    }

    public function getById($id) {
        return mysqli_query($this->conn, "SELECT * FROM students WHERE student_id=$id");
    }

    public function update($id, $full_name, $email, $phone) {
        $sql = "UPDATE students
                SET full_name='$full_name', email='$email', phone='$phone'
                WHERE student_id=$id";
        return mysqli_query($this->conn, $sql);
    }

    public function delete($id) {
        return mysqli_query($this->conn, "DELETE FROM students WHERE student_id=$id");
    }
}
