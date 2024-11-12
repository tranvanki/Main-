<?php
// delete.php
require 'db.php';

$id = $_GET['id'];

// Delete the post
$sql = "DELETE FROM posts WHERE 
id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

// Redirect to homepage
header("Location: index.php");
