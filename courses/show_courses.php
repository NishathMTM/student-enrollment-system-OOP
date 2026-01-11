<?php
require_once '../classes/Course.php';
$course = new Course();
$result = $course->getAll();
$connection = $course->getConnection();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Courses</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex align-items-center mb-3">
        <h2 class="me-auto">Courses</h2>
        <a href="add_courses.php" class="btn btn-success">Add Course</a>
    </div>
            
    <?php if (!$result): ?>
        <div class="alert alert-danger">Query error: <?php echo htmlspecialchars(mysqli_error($course->getConnection())); ?></div>
    <?php else: ?>
        <?php if (mysqli_num_rows($result) === 0): ?>
            <div class="alert alert-info">No courses found.</div>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td>
                            <a href="edit_courses.php?id=<?php echo $row['course_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="delete_courses.php?delete_id=<?php echo $row['course_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this course?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>