<?php
include "../db.php"; 

// Constants
define('TEMPLATES_PATH', __DIR__ . '/templates/');

function getAllUsers( PDO $pdo){
    try{
        $stmt = $pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }catch(PDOException  $e){
        error_log("Error fetching use" . $e->getMessage());
        return [];
    }
}
function addUser(PDO $pdo, $username, $password,$email, $role)
{
    try {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users(username, email, password, role) VALUES (:username, :email, :password, :role)");
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':role' => $role
        ]);
        header("location: admin_function.php?action=view_users");
        exit;
    }catch(PDOException $e)
    {
        error_log("Error adding user: " . $e->getMessage());
        die("An error occurred while adding the user.");
    }
}

// Delete User
function deleteUser(PDO $pdo, $userId) {
    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute([':id' => $userId]);
        header("Location: admin_function.php?action=view_users");
        exit;
    } catch (PDOException $e) {
        error_log("Error deleting user: " . $e->getMessage());
        die("An error occurred while deleting the user.");
    }
}
function editUser(PDO $pdo, $userId, $username, $password, $email, $role) {
    try {
        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE users 
                    SET username = :username, email = :email, password = :password, role = :role 
                    WHERE id = :id";
            $params = [
                ':username' => $username,
                ':email' => $email,
                ':password' => $hashedPassword,
                ':role' => $role,
                ':id' => $userId
            ];
        } else {
            $sql = "UPDATE users 
                    SET username = :username, email = :email, role = :role 
                    WHERE id = :id";
            $params = [
                ':username' => $username,
                ':email' => $email,
                ':role' => $role,
                ':id' => $userId
            ];
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        echo "User successfully updated.";
    } catch (PDOException $e) {
        error_log("Error editing user: " . $e->getMessage());
        die("An error occurred while editing the user.");
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'edit_user') {
        $userId = (int)$_POST['userId'];
        $username = htmlspecialchars($_POST['username']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = $_POST['password']; // Optional
        $role = htmlspecialchars($_POST['role']);
        if ($email && $username && $role) {
            editUser($pdo, $userId, $username, $password, $email, $role);
        } else {
            die("Invalid input data.");
        }
    }}