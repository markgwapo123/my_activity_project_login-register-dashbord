<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: welcome.php');
    exit();
}
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hashing the password (use stronger hashing in real apps)
// Connect to database
    $conn = new mysqli('localhost', 'root', '', 'signup');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Prepare and bind
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE username = ? AND user_password = ?");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['username'] = $username;
        header('Location: welcome.php');
        exit();
    } else {
        $message = "Invalid username or password!";
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container">
        <div class="box">
            <h2>Login Page</h2>
            <form method="post" action="">
                <label>Username: </label><br>
                <input type="text" name="username" required><br><br>
                <label>Password: </label><br>
                <input type="password" name="password" required><br><br>
                <button type="submit" value="Login">Login </button>
            </form>
            <p style="color: red;"><?php echo $message; ?></p>
            <div class = "create">
            <p> Don't have an account?</p>
            </div>
            <div class="sign">
                <a href="index.php">Sign Up</a> 
            </div>
        </div>
    </div>
</body>

</html>