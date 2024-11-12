<?php
// edit.php
require 'db.php';
$id = $_GET['id'];

// Fetch post details
$sql = "SELECT * FROM posts WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$post = $stmt->fetch();

// Fetch users and modules for dropdowns
$users = $pdo->query("SELECT * FROM users")->fetchAll();
$modules = $pdo->query("SELECT * FROM modules")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_POST['user_id'];
    $module_id = $_POST['module_id'];

    // Update the post
    $sql = "UPDATE posts SET title = :title, content = :content, user_id = :user_id, module_id = :module_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'content' => $content, 'user_id' => $user_id, 'module_id' => $module_id, 'id' => $id]);

    // Redirect to homepage
    header("Location: index.php");
}
include "templates/update_post.html.php";

