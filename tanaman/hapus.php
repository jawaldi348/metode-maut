<?php
$kode = $_GET['kode'];
$sql = "SELECT * FROM tanaman WHERE kode_tanaman='$kode'";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_assoc($result);

$error = '';
if (isset($_POST['hapus'])) {
    $kode = $_POST['kode'];
    $query = "DELETE FROM tanaman WHERE kode_tanaman='$kode'";
    $hapus = mysqli_query($link, $query) or trigger_error("Query Failed! SQL: $query - Error: " . mysqli_error($link), E_USER_ERROR);
    if ($hapus) {
        echo '<script type="text/javascript">window.location.replace("home.php?page=tanaman");</script>';
    } else {
        $error = 'Data gagal dirubah';
    }
}
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-widget">
            <form action="" method="post">
                <input type="hidden" name="kode" value="<?= $data['kode_tanaman'] ?>">
                <div class="box-body">
                    <?php
                    if ($error != '') {
                        echo '
                    <div class="alert alert-danger">
                    ' . $error . '
                    </div>
                    ';
                    }
                    ?>
                    <div class="alert alert-warning" style="margin-bottom: 0;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Hapus Data</h4>
                        Yakin untuk menghapus data <b><?= $data['nama_tanaman'] ?></b> ?
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success" name="hapus"><i class="icon-trash"></i> Hapus</button>
                    <a href="?page=tanaman" class="btn btn-danger" data-dismiss="modal"><i class="fa  fa-angle-double-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>