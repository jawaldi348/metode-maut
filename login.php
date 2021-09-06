<?php
session_start();
$error = '';
if (isset($_SESSION['user_data'])) {
    header('location:home.php');
}

if (isset($_POST['login'])) {
    include('config/database.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == '' || $password == '') {
        $error = 'Username dan password tidak boleh kosong';
    } else {
        $sql = "select * from user where BINARY username='$username' AND BINARY password='$password'";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row == null) {
            $error = 'Username dan password tidak ditemukan';
        } else {
            $_SESSION['user_data'] = [
                'id' =>  $row['id_user'],
                'nama' =>  $row['username'],
                'level' =>  $row['level_user']
            ];
            header('location:home.php');
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">

    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <style>
        .login-logo,
        .register-logo {
            font-size: 30px;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="assets/dist/img/logo.png" width="120px" height="120px"><br>
            <b>Dinas Pertanian<br>Kota Pariaman</b>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Masuk ke akun Anda</p>
            <form method="POST">
                <?php
                if ($error != '') {
                    echo '
                    <div class="alert alert-danger">
                    ' . $error . '
                    </div>
                    ';
                }
                ?>
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</body>

</html>