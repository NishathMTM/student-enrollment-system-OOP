<?php
require_once '../classes/Student.php';
$student = new Student();
$result = $student->getAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex align-items-center mb-3">
        <h2 class="me-auto">Students</h2>
        <a href="add_student.php" class="btn btn-success">Add Student</a>
    </div>

    <?php if (!$result): ?>
        <div class="alert alert-danger">Query error: <?php echo htmlspecialchars(mysqli_error($student->getConnection())); ?></div>
    <?php else: ?>
        <?php if (mysqli_num_rows($result) === 0): ?>
            <div class="alert alert-info">No students found.</div>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td>
                            <a href="edit_student.php?id=<?php echo $row['student_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="delete_student.php?delete_id=<?php echo $row['student_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?');">Delete</a>
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
