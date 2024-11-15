<?php

ob_start();
?>
    <div class="card p-4">
        <h2 class="card-title">Add a New Post</h2>
        <form method="POST" action="submit_post.php">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="username">Student:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
            <label for="module_id">Module:</label>
            <select name="module_id" class="form-control" required>
                <?php if (isset($modules) && is_array($modules)): ?>
                    <?php foreach ($modules as $module): ?>
                        <option value="<?= htmlspecialchars($module["id"]) ?>"><?= htmlspecialchars($module["module_name"]) ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option disabled>No modules available</option>
                <?php endif; ?>
            </select>
            </div>
            <div class="form-group">
                <Label for="image">Image</Label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
<?php 
$output=ob_get_clean();
include 'layout.html.php';
?>
