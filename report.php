<?php
require_once 'classes/Enrollment.php';
require_once 'classes/TeacherCourse.php';

$enrollment = new Enrollment();
$teacherCourse = new TeacherCourse();

$enrollmentReport = $enrollment->getAll();
$teacherCourseReport = $teacherCourse->getAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>System Reports</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4">System Reports</h2>

    <!-- Enrollment Report -->
    <h4>Student Enrollment Report</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Course Name</th>
                <th>Enrollment Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($enrollmentReport)) { ?>
                <tr>
                    <td><?= $row['full_name']; ?></td>
                    <td><?= $row['course_name']; ?></td>
                    <td><?= $row['enrollment_date']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <hr>

    <!-- Teacher–Course Report -->
    <h4>Teacher Course Assignment Report</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Teacher Name</th>
                <th>Course Name</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($teacherCourseReport)) { ?>
                <tr>
                    <td><?= $row['full_name']; ?></td>
                    <td><?= $row['course_name']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary mt-3">Back to Dashboard</a>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
