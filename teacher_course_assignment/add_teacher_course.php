<?php
require_once '../classes/TeacherCourse.php';
$tc = new TeacherCourse();

if (isset($_POST['assign_teacher'])) {
    $teacher_id = intval($_POST['teacher_id'] ?? 0);
    $course_id = intval($_POST['course_id'] ?? 0);

    if ($teacher_id > 0 && $course_id > 0) {
        $res = $tc->assign($teacher_id, $course_id);
        if ($res) {
            header('Location: teacher_course.php');
            exit;
        } else {
            // assignment failed (probably duplicate), return with error flag
            header('Location: teacher_course.php?error=duplicate');
            exit;
        }
    } else {
        header('Location: teacher_course.php?error=invalid');
        exit;
    }
}

$result = $tc->getAll();
