<h2>Register</h2>
<form method="POST">
    Username: <input name="username"><br>
    Password: <input name="password" type="password"><br>
    <button type="submit">Register</button>
</form>



<?php

session_start();
require "db.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
}

if(empty($username) || empty($password)){
    echo "Username and password cannot be empty.";
    exit;
} 

$username = trim($username);

if(!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)){
    echo "Username can only contain letters, numbers, and underscores.";
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hash);
if($stmt->execute()){
    echo "Registration successful";
} else {
    echo "Register failed";
}




?>
