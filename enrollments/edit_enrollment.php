<?php
require_once '../classes/Enrollment.php';
require_once '../classes/Student.php';
require_once '../classes/Course.php';

$enrollment = new Enrollment();
$studentModel = new Student();
$courseModel = new Course();

if (!isset($_GET['id'])) {
    header('Location: show_enrollment.php');
    exit;
}
$id = intval($_GET['id']);
$result = $enrollment->getById($id);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Enrollment not found.</div></div>";
    exit;
}

$students = $studentModel->getAll();
$courses = $courseModel->getAll();

$errors = [];
$student_id = $data['student_id'];
$course_id = $data['course_id'];
$enrollment_date = $data['enrollment_date'];

if (isset($_POST['update_enrollment'])) {
    $student_id = intval($_POST['student_id'] ?? 0);
    $course_id = intval($_POST['course_id'] ?? 0);
    $enrollment_date = trim($_POST['enrollment_date'] ?? '');

    if ($student_id <= 0) $errors[] = 'Please select a student.';
    if ($course_id <= 0) $errors[] = 'Please select a course.';
    if ($enrollment_date === '') $errors[] = 'Please provide an enrollment date.';

    if (empty($errors)) {
        $res = $enrollment->update($id, $student_id, $course_id, $enrollment_date);
        if ($res) {
            header('Location: show_enrollment.php');
            exit;
        } else {
            $errors[] = 'Database error: ' . mysqli_error($enrollment->getConnection());
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Enrollment</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Enrollment</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $err): ?>
                    <li><?php echo htmlspecialchars($err); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label class="form-label">Student</label>
            <select name="student_id" class="form-select" required>
                <option value="">-- Select student --</option>
                <?php while($s = mysqli_fetch_assoc($students)): ?>
                    <option value="<?php echo $s['student_id']; ?>" <?php echo ($s['student_id']==$student_id)?'selected':''; ?>><?php echo htmlspecialchars($s['full_name']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Course</label>
            <select name="course_id" class="form-select" required>
                <option value="">-- Select course --</option>
                <?php while($c = mysqli_fetch_assoc($courses)): ?>
                    <option value="<?php echo $c['course_id']; ?>" <?php echo ($c['course_id']==$course_id)?'selected':''; ?>><?php echo htmlspecialchars($c['course_name']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Enrollment Date</label>
            <input type="date" name="enrollment_date" class="form-control" value="<?php echo htmlspecialchars($enrollment_date); ?>">
        </div>
        <button type="submit" name="update_enrollment" class="btn btn-primary">Update Enrollment</button>
        <a href="show_enrollment.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>