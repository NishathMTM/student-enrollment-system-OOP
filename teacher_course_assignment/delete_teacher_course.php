<?php
require_once '../classes/TeacherCourse.php';
$tc = new TeacherCourse();
if (!isset($_GET['delete_id'])) {
    header('Location: teacher_course.php');
    exit;
}
$id = intval($_GET['delete_id']);
$tc->delete($id);
header('Location: teacher_course.php');
exit;
