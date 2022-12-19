<?php

include 'functions.php';


error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: home.php");
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = array(
            'id' => $row['id'],
            'nama' => $row['username']
        );
        header("Location: home.php");
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
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
    <title>TO DO List</title>
</head>

<body class="text-center">

    <main class="form-signin w-100 m-auto">
        <form action="" method="POST">
            <img class="mb-4" src="./images/Grape.png" alt="" width="100" height="100" />
            <h1 class="h3 mb-3 fw-normal">Please Sign In</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" value="<?php echo $email; ?>" required />
                <label for="email">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required />
                <label for="password">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label> <input type="checkbox" value="remember-me" /> Remember me </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" name="submit">Sign in</button>
            <p class="login-register-text">Anda belum punya akun? <a href="register.php">Register</a></p>

            <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
        </form>
    </main>

</body>

</html>