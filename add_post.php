<?php
session_start();
ob_start();

if (!isset($_SESSION['role'])) {
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header('Location: login.php');
    exit();
}

$title = "Add Post";
require 'db.php'; 

$users = $pdo->query("SELECT * FROM users")->fetchAll();
$modules = $pdo->query("SELECT * FROM modules")->fetchAll();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_POST['user_id'];
    $module_id = $_POST['module_id'];

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO posts (title, content, user_id, module_id) VALUES (:title, :content, :user_id, :module_id)";
    $stmt = $pdo->prepare($sql);

    // Execute with parameters directly
    if ($stmt->execute(['title' => $title, 'content' => $content, 'user_id' => $user_id, 'module_id' => $module_id])) {
        echo "Post added.";
    } else {
        echo "Error occurred.";
    }

    // Redirect to the homepage
    header("Location: index.php");
    exit();
}

$output = ob_get_clean();

include "templates/add_post.html.php";
