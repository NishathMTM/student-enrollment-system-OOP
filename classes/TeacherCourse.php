<?php
require_once 'Database.php';

class TeacherCourse extends Database {

    public function assign($teacher, $course) {

    // check for existing assignment
        $check = mysqli_query(
            $this->conn,
            "SELECT * FROM teacher_courses
             WHERE teacher_id='$teacher' AND course_id='$course'"
        );

        // prevent duplicate assignments
        if (mysqli_num_rows($check) == 0) {
            // create new assignment
            return mysqli_query(
                $this->conn,
                "INSERT INTO teacher_courses (teacher_id,course_id)
                 VALUES ('$teacher','$course')"
            );
        }
        // return false if assignment duplicate
        return false;
    }

    public function getAll() {
        return mysqli_query(
            $this->conn,
            "SELECT tc.id, t.full_name, c.course_name
             FROM teacher_courses tc
             INNER JOIN teachers t ON tc.teacher_id=t.teacher_id
             INNER JOIN courses c ON tc.course_id=c.course_id"
        );
    }

    public function delete($id) {
        return mysqli_query($this->conn, "DELETE FROM teacher_courses WHERE id=$id");
    }
}
