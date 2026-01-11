<?php
require_once 'Database.php';

class Course extends Database {

    public function add($name, $desc) {
        return mysqli_query(
            $this->conn,
            "INSERT INTO courses (course_name,description)
             VALUES ('$name','$desc')"
        );
    }

    public function getAll() {
        return mysqli_query($this->conn, "SELECT * FROM courses");
    }

    public function getById($id) {
        return mysqli_query($this->conn, "SELECT * FROM courses WHERE course_id=$id");
    }

    public function update($id, $name, $desc) {
        return mysqli_query(
            $this->conn,
            "UPDATE courses SET course_name='$name', description='$desc'
             WHERE course_id=$id"
        );
    }

    public function delete($id) {
        return mysqli_query($this->conn, "DELETE FROM courses WHERE course_id=$id");
    }
}
