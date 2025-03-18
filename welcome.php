<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  header('Location: welcome.php');
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="welcome.css">
</head>
<body>
  <div class="cons">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <p>You are logged in.</p>
    <a href="logout.php">Logout</a>
  </div>
</body>
</html>