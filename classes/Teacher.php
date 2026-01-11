<?php
require_once 'Database.php';

class Teacher extends Database {

    public function add($name, $phone) {
        return mysqli_query(
            $this->conn,
            "INSERT INTO teachers (full_name,phone)
             VALUES ('$name','$phone')"
        );
    }

    public function getAll() {
        return mysqli_query($this->conn, "SELECT * FROM teachers");
    }

    public function getById($id) {
        return mysqli_query($this->conn, "SELECT * FROM teachers WHERE teacher_id=$id");
    }

    public function update($id, $name, $phone) {
        return mysqli_query(
            $this->conn,
            "UPDATE teachers SET full_name='$name', phone='$phone'
             WHERE teacher_id=$id"
        );
    }

    public function delete($id) {
        return mysqli_query($this->conn, "DELETE FROM teachers WHERE teacher_id=$id");
    }
}
