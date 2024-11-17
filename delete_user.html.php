<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section id="deleteUser">
            <h2>Delete User</h2> 
            <form action="delete_user_handler.php" method="POST"> 
                <label for="userId">User ID:</label> 
                <input type="text" id="userId" name="userId" required><br> 
                <button type="submit">Delete User</button>
                </form>
             </section>
</body>
</html>