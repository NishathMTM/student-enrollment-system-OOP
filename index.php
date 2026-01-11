<?php

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Student Management System</h2>

    <div class="list-group">

        <a href="students/show_student.php" class="list-group-item list-group-item-action">
            Manage Students
        </a>

        <a href="teachers/show_teacher.php" class="list-group-item list-group-item-action">
            Manage Teachers
        </a>

        <a href="courses/show_courses.php" class="list-group-item list-group-item-action">
            Manage Courses
        </a>

        <a href="enrollments/show_enrollment.php" class="list-group-item list-group-item-action">
            Manage Enrollments
        </a>

        <a href="teacher_course_assignment/teacher_course.php" class="list-group-item list-group-item-action">
            Assign Teachers to Courses
        </a>

        <a href="report.php" class="list-group-item list-group-item-action list-group-item-info">
            View Reports
        </a>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
