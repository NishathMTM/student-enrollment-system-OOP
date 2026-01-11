<?php
require_once '../classes/Student.php';
$student = new Student();
if (!isset($_GET['delete_id'])) {
    header('Location: show_student.php');
    exit;
}
$id = intval($_GET['delete_id']);
$student->delete($id);
header('Location: show_student.php');
exit;
