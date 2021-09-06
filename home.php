<?php
error_reporting(~E_NOTICE);
include('config/database.php');
session_start();
if (!isset($_SESSION['user_data'])) {
    header('location:index.php');
}
$page = '';
$page = $_GET['page'];
$form = $_GET['form'];
$session = $_SESSION['user_data'];
$level = $session['level'];
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
    <script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="assets/dist/js/adminlte.min.js"></script>
    <script src="assets/dist/js/demo.js"></script>
    <script>
        $(function() {
            $('#data-tabel').DataTable({
                ordering: false
            })
        });
    </script>
</head>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="home.php" class="navbar-brand">Metode <b>MAUT</b></a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="<?= $page == '' ? 'active' : null ?>">
                                <a href="home.php"><i class="fa fa-home"></i> Home</a>
                            </li>
                            <?php if ($level == 1) : ?>
                                <li class="<?= $page == 'tanaman' ? 'active' : null ?>">
                                    <a href="?page=tanaman"><i class="glyphicon glyphicon-tree-deciduous"></i> Tanaman</a>
                                </li>
                                <li class="<?= $page == 'kriteria' ? 'active' : null ?>">
                                    <a href="?page=kriteria"><i class="glyphicon glyphicon-th-large"></i> Kriteria</a>
                                </li>
                                <li class="<?= $page == 'penilaian' ? 'active' : null ?>">
                                    <a href="?page=penilaian"><i class="glyphicon glyphicon-list-alt"></i> Penilaian Kriteria</a>
                                </li>
                                <li class="<?= $page == 'hasil' ? 'active' : null ?>">
                                    <a href="?page=hasil"><i class="glyphicon glyphicon-check"></i> Perhitungan</a>
                                </li>
                            <?php elseif ($level == 2) : ?>
                                <li class="<?= $page == 'penilaian' ? 'active' : null ?>">
                                    <a href="?page=penilaian"><i class="glyphicon glyphicon-list-alt"></i> Penilaian Kriteria</a>
                                </li>
                                <li class="<?= $page == 'hasil' ? 'active' : null ?>">
                                    <a href="?page=hasil"><i class="glyphicon glyphicon-check"></i> Perhitungan</a>
                                </li>
                            <?php elseif ($level == 3) : ?>
                                <li class="<?= $page == 'hasil' ? 'active' : null ?>">
                                    <a href="?page=hasil"><i class="glyphicon glyphicon-check"></i> Perhitungan</a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a href="?page=logout"><i class="fa fa-power-off"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="assets/dist/img/avatar5.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?= $_SESSION['user_data']['nama'] ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                                        <p>
                                            <?= $_SESSION['user_data']['nama'] ?> - <?= $_SESSION['user_data']['level'] == 1 ? 'Admin' : 'Kepala Dinas' ?>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="?page=user" class="btn btn-default btn-flat">User</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="?page=logout" class="btn btn-default btn-flat">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="content-wrapper">
            <div class="container">
                <section class="content">
                    <?php
                    if ($page == "tanaman") {
                        if ($form == 'tambah') {
                            include("tanaman/tambah.php");
                        } else if ($form == 'edit') {
                            include("tanaman/edit.php");
                        } else if ($form == 'hapus') {
                            include("tanaman/hapus.php");
                        } else {
                            include("tanaman/data.php");
                        }
                    } else if ($page == 'kriteria') {
                        if ($form == 'tambah_kriteria') {
                            include("kriteria/tambah.php");
                        } else if ($form == 'edit_kriteria') {
                            include("kriteria/edit.php");
                        } else if ($form == 'hapus_kriteria') {
                            include("kriteria/hapus.php");
                        } else if ($form == 'tambah_kriteria_nilai') {
                            include("kriteria_nilai/tambah.php");
                        } else if ($form == 'edit_kriteria_nilai') {
                            include("kriteria_nilai/edit.php");
                        } else if ($form == 'hapus_nilai_bobot') {
                            include("bobot/hapus.php");
                        } else {
                            include("kriteria/data.php");
                        }
                    } else if ($page == 'penilaian') {
                        if ($form == 'tambah') {
                            include("penilaian/tambah.php");
                        } else if ($form == 'edit') {
                            include("penilaian/edit.php");
                        } else if ($form == 'hapus') {
                            include("penilaian/hapus.php");
                        } else {
                            include("penilaian/data.php");
                        }
                    } else if ($page == 'hasil') {
                        include("hasil/data.php");
                    } else if ($page == 'logout') {
                        unset($_SESSION['user_data']);
                        echo '<script type="text/javascript">window.location.replace("index.php");</script>';
                    } elseif ($page == "user") {
                        if ($form == 'tambah') {
                            include("user/tambah.php");
                        } else if ($form == 'edit') {
                            include("user/edit.php");
                        } else if ($form == 'hapus') {
                            include("user/hapus.php");
                        } else {
                            include("user/data.php");
                        }
                    } else {
                        include("content.php");
                    }
                    ?>
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