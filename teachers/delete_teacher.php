<?php
require_once '../classes/Teacher.php';
$teacher = new Teacher();
if (!isset($_GET['delete_id'])) {
    header('Location: show_teacher.php');
    exit;
}
$id = intval($_GET['delete_id']);
$teacher->delete($id);
header('Location: show_teacher.php');
exit;