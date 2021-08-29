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
        $sql = "select * from user where username='$username' AND password='$password'";
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
    <title>SPK Metode Maut</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="assets/bower_components/icomoon/styles.css">

    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="assets/dist/js/adminlte.min.js"></script>
    <script src="assets/dist/js/demo.js"></script>
</head>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active">
                                <a href="index.php"><i class="fa fa-home"></i> Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="content-wrapper">
            <div class="container">
                <section class="content">
                    <div class="row">
                        <h3 class="box-title text-center" style="padding-bottom: 10px;">Sistem Pendukung Keputusan Pemilihan Tanaman Pangan Menggunakan<br />Metode Multi Attribute Utility Theory</h3>
                        <div class="col-md-8 col-md-offset-2">
                            <div class="box box-widget">
                                <div class="box-header with-border text-center">
                                    <h3 class="box-title">Login</h3>
                                </div>
                                <form action="" method="post">
                                    <div class="box-body">
                                        <?php
                                        if ($error != '') {
                                            echo '<div class="alert alert-danger">' . $error . '</div>';
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" class="form-control" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="box-footer text-center">
                                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0
                </div>
                <strong>Copyright &copy; 2021 <a href="#">Metode Multi Attribute Utility Theory</a>.</strong>
            </div>
        </footer>
    </div>

</body>

</html>