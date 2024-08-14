<?php
session_start();

// Hardcoded credentials for simplicity
$correct_username = 'admin';
$correct_password = 'password';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $correct_username && $password === $correct_password) {
        // Set session variable to indicate the user is logged in
        $_SESSION['loggedin'] = true;
        header('Location: Guestlist.php');
        exit;
    } else {
        echo "Login unsuccessful. Please try again.";
    }
}
