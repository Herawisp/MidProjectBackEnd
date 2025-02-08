<?php
// delete_user.php

// Include the necessary files (e.g., database connection, UsersController)
require '../class/UsersController.php';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Create an instance of UsersController
    $uc = new UsersController();

    // Call the deleteUser method (you need to implement this method in UsersController)
    $result = $uc->deleteUser($userId);

    if ($result) {
        // Redirect back to the admin dashboard with a success message
        header("Location: dashboard.php");
        exit();
    } else {
        // Redirect back to the admin dashboard with an error message
        header("Location: dashboard.php?");
        exit();
    }
} else {
    // Redirect back to the admin dashboard if no ID is provided
    header("Location: dashboard.php");
    exit();
}