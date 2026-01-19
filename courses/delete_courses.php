<?php
require_once '../classes/Course.php';

$course = new Course();
if (!isset($_GET['delete_id'])) {
    header('Location: show_courses.php');
    exit;
}
$id = intval($_GET['delete_id']);
$course->delete($id);
header('Location: show_courses.php');
exit;
