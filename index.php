<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signup";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["password"];


    if (empty($firstname) || empty($middlename) || empty($lastname) || empty($password) || empty($password)) {
        echo "Please fill in all fields.";
        exit;
    }

    $hashed_password = md5($password);

    $stmt = $conn->prepare("INSERT INTO users (user_lname, user_fname, user_mname, username, user_password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstname, $middlename, $lastname, $username, $hashed_password);
    if ($stmt->execute()) {
        echo "<p class='new'>Sign Up successfully</span></p>";

    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Activity #2</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="container">
        <div class="signupform">
            <h2>Sign Up</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"
                        autofocus required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name"
                        required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name"
                        required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                        required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                </div>
                <button type="submit">SignUp</button>
            </form>
        </div>
            <div class="loginpage">
                <a href="login.php">click to login</a>
            </div>
    </div>
</body>

</html>