<?php
require_once '../classes/Enrollment.php';
$enrollment = new Enrollment();
if (!isset($_GET['delete_id'])) {
    header('Location: show_enrollment.php');
    exit;
}
$id = intval($_GET['delete_id']);
$enrollment->delete($id);
header('Location: show_enrollment.php');
exit;