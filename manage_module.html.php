<!DOCTYPE html>
<html>
<head>
    <title>Manage Modules</title>
</head>
<body>
    <h1>Manage Modules</h1>
    <ul>
        <?php foreach ($modules as $module): ?>
            <li><?= htmlspecialchars($module['name']) ?> - <a href="admin_function.php?action=delete_module&id=<?= $module['id'] ?>">Delete</a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
