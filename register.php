<?php

include 'functions.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO users (username, email, password)
                    VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!');
                document.location.href = 'index.php';
                </script>";
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./signin.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

    <title>Kelompok Grape Register</title>
</head>

<body class="text-center">
    <main class="form-signin w-100 m-auto">
        <form action="" method="POST">
            <img class="mb-4" src="./images/Grape.png" alt="" width="100" height="100" />
            <h1 class="h3 mb-3 fw-normal">Please Sign Up</h1>

            <div class="form-floating">
                <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $username; ?>" required />
                <label>Username</label>
            </div>

            <div class="form-floating">
                <input type="email" class="form-control" name="email" placeholder="name@example.com" value="<?php echo $email; ?>" required />
                <label>Email address</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $_POST['password']; ?>" required />
                <label>Password</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" name="cpassword" placeholder="Password" value="<?php echo $_POST['cpassword']; ?>" required />
                <label>Confirm Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" name="submit">Register</button>
            <p class="login-register-text">Anda sudah punya akun? <a href="index.php">Login </a></p>

            <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
        </form>
    </main>
</body>

</html>