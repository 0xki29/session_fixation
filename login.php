<h1>Login</h1>

<form method="POST" action="login.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    
    <input type="submit" value="Login">
</form>

<?php 

if(isset($_GET['PHPSESSID'])){
    session_id($_GET['PHPSESSID']);
}
session_start();
require "db.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
}

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");

$stmt->bind_param("s", $username);

$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();
if($user && password_verify($password, $user['password'])){

    
    // session_regenerate_id(true); Session fixation protection
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header("Location: dashboard.php");

}
else{
    echo("invalid username or password");
}

?>