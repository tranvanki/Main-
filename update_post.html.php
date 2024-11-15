<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
</head>
<body>
    <h2>Edit Post</h2>
    <form method="POST">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?= $post['title'] ?>" required><br><br>
        <label>Content:</label><br>
        <textarea name="content" required><?= $post['content'] ?></textarea><br><br>
        
        <label>User:</label><br>
        <select name="user_id" required>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['id'] ?>" <?= ($user['id'] == $post['user_id']) ? 'selected' : '' ?>>
                    <?= $user['username'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Module:</label><br>
        <select name="module_id" required>
            <?php foreach ($modules as $module): ?>
                <option value="<?= $module['id'] ?>" <?= ($module['id'] == $post['module_id']) ? 'selected' : '' ?>>
                    <?= $module['module_name'] ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
