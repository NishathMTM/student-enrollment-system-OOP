<?php
require_once '../classes/Student.php';
$student = new Student();

// Validate and fetch ID
if (!isset($_GET['id'])) {
    header('Location: show_student.php');
    exit;
}
$id = intval($_GET['id']);
$result = $student->getById($id);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Student not found.</div></div>";
    exit;
}

if (isset($_POST['update_student'])) {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    $student->update($id, $full_name, $email, $phone);
    header("Location: show_student.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Student</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Student</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" required value="<?php echo htmlspecialchars($data['full_name']); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($data['email']); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($data['phone']); ?>">
        </div>
        <button type="submit" name="update_student" class="btn btn-primary">Update Student</button>
        <a href="show_student.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
