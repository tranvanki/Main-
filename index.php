<?php
session_start();
ob_start();

$title = "Homepage";
include 'db.php';

function fetchPosts($pdo, $searchQuery = null, $limit = 10, $offset = 0) {
    $baseSQL = "SELECT posts.*, users.username, modules.module_name 
                FROM posts 
                JOIN users ON posts.user_id = users.id 
                JOIN modules ON posts.module_id = modules.id";
                
    $params = [];
    if ($searchQuery) {
        $baseSQL .= " WHERE posts.title LIKE :query OR posts.content LIKE :query";
        $params['query'] = '%' . trim($searchQuery) . '%';
    }

    $baseSQL .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
    $params['limit'] = $limit;
    $params['offset'] = $offset;

    try {
        $stmt = $pdo->prepare($baseSQL);
        foreach ($params as $key => &$val) { // Needed for PDO::PARAM binding by reference
            $stmt->bindParam($key, $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        return [];
    }
}
// Handle AJAX request for search functionality
if (isset($_GET['search_query'])) {
    header('Content-Type: application/json');
    $searchQuery = $_GET['search_query'];
    $posts = fetchPosts($pdo, $searchQuery);
    echo json_encode($posts);
    exit;
}
// Capture the page content for layout
$posts = fetchPosts($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title><?= $title ?></title>
</head>
<body>
    <h1>Welcome to the Homepage</h1>

    <div class="search">
        <i class="fas fa-magnifying-glass" style="margin-right: auto; position: absolute; color: grey"></i>
        <input type="text" id="searchInput" placeholder="Search posts...">
        <button id="searchButton">Search</button>
        
    </div>
    <div id="searchResults"></div>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
        <p>You are logged in as an admin.</p>
        <?php 
        if (isset($_GET['logout'])) {
            session_unset();
            session_destroy();
            header("Location: login.php"); 
            exit();
        } ?>
        <a href="index.php?logout=true">Logout</a> 
    <?php else: ?>
        <a class="btnLogin-popup" href="login.php">Login</a> 
        <a class="btnLogin-popup" href="signup.html">Signup</a>
    <?php endif; ?>

    <h2>All Posts</h2>
    <?php foreach ($posts as $post): ?>
        <h3><?= htmlspecialchars($post['title']) ?></h3>
        <p><?= htmlspecialchars($post['content']) ?></p>
        <p>Posted by: <?= htmlspecialchars($post['username']) ?> in <?= htmlspecialchars($post['module_name']) ?></p>

        <?php if (isset($_SESSION['role'])): ?>
            <a href="update_post.php?id=<?= $post['id'] ?>">Update Post</a> |
            <a href="delete.php?id=<?= $post['id'] ?>">Delete</a>
        <?php endif; ?>
        <hr>
    <?php endforeach; ?>
    <script src="search.js" defer></script>
</body>
</html>

<?php
$output = ob_get_clean();
require 'templates/layout.html.php';
?>
