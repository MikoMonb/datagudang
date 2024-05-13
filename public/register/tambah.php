<?php 
    include_once("../../config/koneksi.php");
    include_once("tambahakun.php");

    $akunController = new AkunController($kon);

    if (isset($_POST['submit'])) {
        $id_user = $akunController->tambahAkun();

        $data = [
            'id_user' => $id_user,
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'email' => $_POST['email'], 
        ];

        $message = $akunController->tambahDataAkun($data);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>
<body>
    <h1>Register Akun</h1>
    <form action="tambah.php" method="post" name="tambah" enctype="multipart/form-data">
        <table border="0">
            <tr>
                <td> ID User </td>
                <td> : </td>
                <td><input type="text" name="id_user" value="<?php echo($akunController->tambahAkun()); ?>" readonly></td>
            </tr>
            <tr>
                <td> Username </td>
                <td> : </td>
                <td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <td> Email </td>
                <td> : </td>
                <td><input type="text" name="email" required></td>
            </tr>
            <tr>
                <td> Password </td>
                <td> : </td>
                <td><input type="text" name="password" required></td>
            </tr>
        </table>
        <p>Sudah Memiliki Akun? <span><a href="../../login.php">Login</a></span></p>
        <input type="submit" name="submit" value="tambah Akun">
        <?php if (isset($message)) : ?>
            <div class="success-message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>