<?php
require_once '../classes/Course.php';
$course = new Course();

$errors = [];
$course_name = '';
$description = '';

// check if form is submitted
if (isset($_POST['save_course'])) {
    // get and validate input data
    $course_name = trim($_POST['course_name'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($course_name === '') {
        $errors[] = 'Course name is required.';
    }

    // if no errors, add the course and save to database
    if (empty($errors)) {
        $res = $course->add($course_name, $description);
        if ($res) {
            header("Location: show_courses.php");
            exit;
        } else {
            $errors[] = 'Database error: ' . mysqli_error($course->getConnection());
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Course</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Add Course</h2>

    <!-- check if error exists -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <!-- array iteration process -->
                <?php foreach ($errors as $err): ?>
                    <!-- $errors = [
                        0 => 'Course name is required',
                        1 => 'Description too short'
                    ]; -->

                    <!-- List Item with Output Encoding -->
                    <li><?php echo htmlspecialchars($err); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" name="course_name" class="form-control" required value="<?php echo htmlspecialchars($course_name); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"><?php echo htmlspecialchars($description); ?></textarea>
        </div>
        <button type="submit" name="save_course" class="btn btn-success">Save Course</button>
        <a href="show_courses.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
