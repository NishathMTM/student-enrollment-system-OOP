<?php
require_once '../classes/Teacher.php';
$teacher = new Teacher();

$errors = [];
$full_name = '';
$phone = '';

if (isset($_POST['save_teacher'])) {
    $full_name = trim($_POST['full_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if ($full_name === '') {
        $errors[] = 'Full name is required.';
    }

    if (empty($errors)) {
        $res = $teacher->add($full_name, $phone);
        if ($res) {
            header('Location: show_teacher.php');
            exit;
        } else {
            $errors[] = 'Database error: ' . mysqli_error($teacher->getConnection());
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Teacher</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Add Teacher</h2>

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
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" required value="<?php echo htmlspecialchars($full_name); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($phone); ?>">
        </div>
        <button type="submit" name="save_teacher" class="btn btn-success">Save Teacher</button>
        <a href="show_teacher.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

