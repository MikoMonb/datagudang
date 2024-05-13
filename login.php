<?php 
    session_start();
    include_once("config/koneksi.php");

    if ($kon->connect_error) {
        die("Connection Failed: " . $kon->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($kon, $_POST['username']);
        $password = mysqli_real_escape_string($kon, $_POST['password']);

        $sql = "SELECT id_user, username, password FROM user WHERE username = '$username' AND password = '$password'";
        $result = $kon->query($sql);

        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $_SESSION['user_id'] = $row['id_user'];
            $_SESSION['username'] = $row['username'];

            header("Location: public/dashboard.php");
        } else {
            echo "Failed Login, invalid username or password";
        }
    }

    $kon->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login Page</h1>
    <form method="post" action="">
        <label for="username">Username: </label>
        <input type="text" name="username" required><br><br>
        <label for="password">Password: </label>
        <input type="password" name="password" required><br>
        <p>Tidak Punya Akun? <span><a href="public/register/tambah.php">Register</a></span></p>
        <input type="submit" value="Login">
    </form>
</body>
</html>