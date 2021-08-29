<?php
$kode = $_GET['kode'];
$sql = "SELECT kode_nilai,nama_tanaman,nama_kriteria,nilai_tanaman FROM tanaman JOIN nilai_tanaman ON tanaman.kode_tanaman=nilai_tanaman.kode_tanaman
JOIN kriteria ON kriteria.kode_kriteria=nilai_tanaman.kode_kriteria WHERE kode_nilai='$kode'";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_assoc($result);

$error = '';
if (isset($_POST['hapus'])) {
    $kode = $_POST['kode'];
    $query = "DELETE FROM nilai_tanaman WHERE kode_nilai='$kode'";
    $hapus = mysqli_query($link, $query) or trigger_error("Query Failed! SQL: $query - Error: " . mysqli_error($link), E_USER_ERROR);
    if ($hapus) {
        echo '<script type="text/javascript">window.location.replace("home.php?page=penilaian");</script>';
    } else {
        $error = 'Data gagal dirubah';
    }
}
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-widget">
            <form action="" method="post">
                <input type="hidden" name="kode" value="<?= $data['kode_nilai'] ?>">
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
                        Yakin untuk menghapus data <b><?= $data['nama_tanaman'] ?></b> dengan kriteria<b> <?= $data['nama_kriteria'] ?></b> dan nilai <b><?= $data['nilai_tanaman'] ?></b>?
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success" name="hapus"><i class="icon-trash"></i> Hapus</button>
                    <a href="?page=penilaian" class="btn btn-danger" data-dismiss="modal"><i class="fa  fa-angle-double-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>