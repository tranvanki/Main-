<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section id="addUser"><h2>Add User</h2> <form action="add_user_handler.php" method="POST">
                 <label for="username">Username:</label>
                  <input type="text" id="username" name="username" required><br> 
                  <label for="email">Email:</label> 
                  <input type="email" id="email" name="email" required><br> 
                  <label for="password">Password:</label> 
                  <input type="password" id="password" name="password" required><br> 
                  <button type="submit">Add User</button> 
                </form></section>
</body>
</html>