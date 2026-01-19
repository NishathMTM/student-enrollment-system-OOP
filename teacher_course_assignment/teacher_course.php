<?php
require_once '../classes/TeacherCourse.php';
require_once '../classes/Teacher.php';
require_once '../classes/Course.php';

$tc = new TeacherCourse();
$teacherModel = new Teacher();
$courseModel = new Course();

$assignments = $tc->getAll();
$teachers = $teacherModel->getAll();
$courses = $courseModel->getAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher - Course Assignments</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex align-items-center mb-3">
        <h2 class="me-auto">Teacher-Course Assignments</h2>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <!-- show duplicate warning -->
        <?php if ($_GET['error'] === 'duplicate'): ?>
            <div class="alert alert-warning">This assignment already exists.</div>
        <!-- show invalid section error     -->
        <?php elseif ($_GET['error'] === 'invalid'): ?>
            <div class="alert alert-danger">Invalid teacher or course selection.</div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Assign Teacher to Course</h5>
            <form method="post" action="add_teacher_course.php">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <select name="teacher_id" class="form-select" required>
                            <option value="">-- Select teacher --</option>
                            <?php while($t = mysqli_fetch_assoc($teachers)): ?>
                                <option value="<?php echo $t['teacher_id']; ?>"><?php echo htmlspecialchars($t['full_name']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <select name="course_id" class="form-select" required>
                            <option value="">-- Select course --</option>
                            <?php while($c = mysqli_fetch_assoc($courses)): ?>
                                <option value="<?php echo $c['course_id']; ?>"><?php echo htmlspecialchars($c['course_name']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button type="submit" name="assign_teacher" class="btn btn-success">Assign</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if (!$assignments): ?>
        <div class="alert alert-danger">Query error: <?php echo htmlspecialchars(mysqli_error($tc->getConnection())); ?></div>
    <?php else: ?>
        <?php if (mysqli_num_rows($assignments) === 0): ?>
            <div class="alert alert-info">No assignments found.</div>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Teacher</th>
                        <th>Course</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i=1; while($row = mysqli_fetch_assoc($assignments)): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                        <td>
                            <a href="delete_teacher_course.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Remove assignment?');">Remove</a>
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