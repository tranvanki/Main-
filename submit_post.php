<?php
include 'db.php'; 
// Fetch the username from the form
$username = $_POST['username'];
$title = $_POST['title'];
$content = $_POST['content'];
$module_id = $_POST['module_id'];


try {
    // Step 1: Lookup user_id based on username
    $db = new PDO("mysql:host=localhost;dbname=studentqa", "root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db ->prepare("SELECT id FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Step 2: Use the user_id for inserting the post
        $user_id = $user['id'];

        $sql = "INSERT INTO posts (title, content, user_id, module_id, created_at)
                VALUES (:title, :content, :user_id, :module_id, NOW())";
        $stmt = $db ->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':module_id', $module_id);
        $stmt->execute();

        echo "Post submitted successfully!";

    } else {
        echo "Error: Username not found!";
    }
    header("location:index.php");
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
