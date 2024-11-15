<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Q&A</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/layout.css">


</head>
<body>
    <div class="container my-5">
    <div class="content">
    <header>
    <h1 class="text-center mb-4">Student Q&A Platform</h1>
    <nav class="mb-4">
            <a href="index.php" class="btn btn-primary">Home</a>
            <a href="add_post.php" class="btn btn-secondary">Add Post</a>
            <a href="contact.php" class="btn btn-info">Contact Admin</a>
            <a href="index.php" class="btn btn-info">Log Out</a>

    </nav>
    </header>
    

        <main > 
        <?php if (isset($output)) : ?>
                <div class="card p-3 mb-4">
                    <?= $output ?>
                </div>
            <?php endif; ?>
           
        </main>
        <hr>
        </div>
        <footer class="text-center mt-5">
        <small>
        <p>Copyright © . All Rights Reserved.</p> 
      <p>Author name: Nguyen Kieen</p>
      <p>Email: trungkieen@gmail.com</p>
    </small>

        </footer>
</div>
</body>


</html>
