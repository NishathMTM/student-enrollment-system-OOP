<?php
require_once 'Database.php';

class Enrollment extends Database {

    public function add($student, $course, $date) {
        return mysqli_query(
            $this->conn,
            "INSERT INTO enrollments (student_id,course_id,enrollment_date)
             VALUES ('$student','$course','$date')"
        );
    }

    public function getAll() {
        return mysqli_query(
            $this->conn,
            "SELECT e.id, s.full_name, c.course_name, e.enrollment_date
             FROM enrollments e
             INNER JOIN students s ON e.student_id=s.student_id
             INNER JOIN courses c ON e.course_id=c.course_id"
        );
    }

    public function getById($id) {
        return mysqli_query($this->conn, "SELECT * FROM enrollments WHERE id=$id");
    }

    public function update($id, $student, $course, $date) {
        return mysqli_query(
            $this->conn,
            "UPDATE enrollments
             SET student_id='$student', course_id='$course', enrollment_date='$date'
             WHERE id=$id"
        );
    }

    public function delete($id) {
        return mysqli_query($this->conn, "DELETE FROM enrollments WHERE id=$id");
    }
}
