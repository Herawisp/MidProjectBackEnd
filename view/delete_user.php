<?php
require '../class/UsersController.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $uc = new UsersController();
    $result = $uc->deleteUser($userId);

    if ($result) {
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: dashboard.php?");
        exit();
    }
} else {
    header("Location: dashboard.php");
    exit();
}